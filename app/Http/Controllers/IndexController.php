<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $currentYear = now()->year;
        $start = $request->input('startdate') ?? "{$currentYear}-01-01";
        $end = $request->input('enddate') ?? now()->format('Y-m-d');
        // dd($start);

        $query = DB::table('bkm_do_kecil_header')
        ->select([
            'bkm_sites.nama AS site',
            'bkm_do_kecil_header.no_do_kecil AS do_kecil',
            'bkm_do_kecil_header.id AS do_kecil_id',
            'bkm_do_kecil_header.createdAt AS tanggal_do_kecil',
            'bkm_do_besar.no_do_besar AS do_besar',
            'bkm_do_besar.id AS do_besar_id',
            'bkm_komoditi.nama_komoditi AS komoditi',
            'bkm_do_kecil_header.no_spb',
            'bkm_user_karyawan.nama AS driver',
            'bkm_kendaraan.no_polisi AS nopol',
            'bkm_tipe_kendaraan.tipe AS tipe_kendaraan',
            'bkm_customer_pks.kode AS PKS',
            'bkm_tujuan_bongkar.kode AS tujuan',
            'bkm_do_kecil_header.tgl_muat AS tanggal_muat',
            'bkm_do_kecil_header.bruto_muat',
            'bkm_do_kecil_header.tarra_muat',
            'bkm_do_kecil_detail.muat AS netto_muat',
            'bkm_do_kecil_header.tgl_bongkar AS tanggal_bongkar',
            'bkm_do_kecil_header.bruto_bongkar',
            'bkm_do_kecil_header.tarra_bongkar',
            'bkm_do_kecil_detail.bongkar AS netto_bongkar',
            DB::raw('bkm_do_kecil_detail.bongkar - bkm_do_kecil_detail.muat AS susut'),
            'bkm_ongkos_angkut.ongkos_angkut',
            DB::raw('bkm_do_kecil_detail.muat * bkm_ongkos_angkut.ongkos_angkut AS value_muat'),
            DB::raw('bkm_do_kecil_detail.bongkar * bkm_ongkos_angkut.ongkos_angkut AS value_bongkar'),
            'bkm_do_kecil_header.status'
        ])
        ->leftJoin('bkm_do_kecil_detail', 'bkm_do_kecil_detail.headerId', '=', 'bkm_do_kecil_header.id')
        ->leftJoin('bkm_do_besar', 'bkm_do_besar.id', '=', 'bkm_do_kecil_detail.dOBesarId')
        ->leftJoin('bkm_customer_pks', 'bkm_customer_pks.id', '=', 'bkm_do_besar.customerPKSId')
        ->leftJoin('bkm_komoditi', 'bkm_komoditi.id', '=', 'bkm_do_besar.komoditiId')
        ->leftJoin('bkm_ongkos_angkut', 'bkm_ongkos_angkut.id', '=', 'bkm_do_kecil_detail.ongkosAngkutId')
        ->leftJoin('bkm_kendaraan', 'bkm_kendaraan.id', '=', 'bkm_do_kecil_header.kendaraanId')
        ->leftJoin('bkm_tipe_kendaraan', 'bkm_tipe_kendaraan.id', '=', 'bkm_kendaraan.tipeKendaraanId')
        ->leftJoin('bkm_assign_driver_kendaraan', 'bkm_assign_driver_kendaraan.kendaraanId', '=', 'bkm_do_kecil_header.kendaraanId')
        ->leftJoin('bkm_user_karyawan', 'bkm_user_karyawan.id', '=', 'bkm_assign_driver_kendaraan.karyawanId')
        ->leftJoin('bkm_tujuan_bongkar', 'bkm_tujuan_bongkar.id', '=', 'bkm_do_besar.tujuanBongkarId')
        ->leftJoin('bkm_sites', 'bkm_sites.id', '=', 'bkm_customer_pks.businessSiteId')
        ->whereNotIn('bkm_do_kecil_header.status', ['DELETIONAPPROVAL', 'DELETED', 'DECLINED', 'REJECTIONAPPROVAL', 'REJECTED'])
        ->where('bkm_do_kecil_header.tgl_bongkar', '>=', $start)
        ->where('bkm_do_kecil_header.tgl_bongkar', '<=', $end)
        ->orderBy('bkm_do_besar.id', 'asc')
        ->get();

        // dd($query);
    

        return view('index', ['query' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
