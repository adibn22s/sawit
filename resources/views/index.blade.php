<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sawit Logistic</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">
    <nav class="bg-white shadow-md rounded-lg mb-5">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">
                Laporan Sawit Logistic
            </div>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Laporan</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Tentang</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Kontak</a>
            </div>
        </div>
    </nav>
    <form action="" class="max-w-xl p-6 bg-white rounded-lg shadow-md mb-5">
        <h4 class="mb-5 text-xl font-semibold text-gray-800">Periode</h4>
        <div id="date-range-picker" date-rangepicker class="flex items-center">
            <div class="relative flex-1 mr-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-range-start" name="startdate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 transition duration-200 ease-in-out" placeholder="Select date start">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative flex-1 ml-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-range-end" name="enddate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 transition duration-200 ease-in-out" placeholder="Select date end">
            </div>
            <div class="p-4">
                <button type="submit" class="w-full py-2 px-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">Search </button>
            </div>
        </div>
    </form>
    
    <h1 class="text-3xl font-bold text-center text-red-500 mb-6">Hasil Laporan Sawit Logistic</h1>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-red-400 text-white">
                    <th class="py-3 px-4 border text-xs">No. Do Kecil</th>
                    <th class="py-3 px-4 border text-xs">Tgl DO Kecil</th>
                    <th class="py-3 px-4 border text-xs">Nama Sopir</th>
                    <th class="py-3 px-4 border text-xs">Muat</th>
                    <th class="py-3 px-4 border text-xs">Bongkar</th>
                    <th class="py-3 px-4 border text-xs">Susut</th>
                    <th class="py-3 px-4 border text-xs">Toleransi</th>
                    <th class="py-3 px-4 border text-xs">Susut diatas toleransi</th>
                    <th class="py-3 px-4 border text-xs">Denda Susut Sopir</th>
                    <th class="py-3 px-4 border text-xs">Kontribusi tdk susut</th>
                    <th class="py-3 px-4 border text-xs">Kontribusi Bonus</th>
                    <th class="py-3 px-4 border text-xs">Bonus antar teman</th>
                    <th class="py-3 px-4 border text-xs">isKenaDenda</th>
                </tr>
            </thead>
            <tbody>
                @php
                $toleransi = 0;
                $percentageBonus = 0;
                $totalMuat = 0;
                $totalBongkar = 0;   
                $totalSusut = 0;
                $totalToleransi = 0;
                $totalSusutDiatasToleransi = 0;
                $totalDendaSusutSopir = 0;
                $totalKontribusiTidakSusut = 0;
                $dendaFR = 0;
                $sisaDenda = 0;
                $totalBonusAntarTeman= 0;
                $totalKontribusiBonus = 0;
                @endphp

                @foreach ($query as $q)
                <?php 
                $toleransi = (ceil(($q->netto_muat * 0.0025) / 10) * 10) * -1; 
                $susutDiatasToleransi = ($q->susut - $toleransi);
                $dendaSusutSopir = 20000 * $susutDiatasToleransi * (-1);
                $kontribusiTidakSusut = ($toleransi - $q->susut );
                $totalMuat += $q->netto_muat;
                $totalBongkar += $q->netto_bongkar;
                $totalSusut += $q->susut;
                $totalToleransi += $toleransi;
                $totalSusutDiatasToleransi += $susutDiatasToleransi;
                $totalDendaSusutSopir += $dendaSusutSopir;
                $totalKontribusiTidakSusut += $kontribusiTidakSusut;
                $percentageBonus = $kontribusiTidakSusut <= 0 ? ( abs($kontribusiTidakSusut) / $totalKontribusiTidakSusut) * 100 : 0;
                $dendaFR = $totalKontribusiTidakSusut * 10000 * 3;
                $sisaDenda =  $dendaFR - $totalDendaSusutSopir;
                $bonusAntarTeman = (ceil($percentageBonus) / 100) * $sisaDenda;
                $totalBonusAntarTeman += $bonusAntarTeman;
                $totalKontribusiBonus += ceil($percentageBonus);
                ?>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $q->do_kecil }}</td>
                    <td class="py-2 px-4 border">{{ date('d-M-Y', strtotime($q->tanggal_do_kecil)) }}</td>
                    <td class="py-2 px-4 border">{{ $q->driver }}</td>
                    <td class="py-2 px-4 border">{{ $q->netto_muat }}</td>
                    <td class="py-2 px-4 border">{{ $q->netto_bongkar }}</td>
                    <td class="py-2 px-4 border">{{ $q->susut }}</td>
                    <td class="py-2 px-4 border">{{ $toleransi }}</td>
                    <td class="py-2 px-4 border">{{ $susutDiatasToleransi }}</td>
                    <td class="py-2 px-4 border">{{ $dendaSusutSopir >= 0 ? formatRupiah($dendaSusutSopir) :  'Rp. 0' }}</td>
                    <td class="py-2 px-4 border">{{ $kontribusiTidakSusut <= 0 ? abs($kontribusiTidakSusut) : '0'}}</td>
                    <td class="py-2 px-4 border">{{ abs(ceil($percentageBonus)) . ' %' }}</td>
                    <td class="py-2 px-4 border">{{formatRupiah($bonusAntarTeman)}}</td>
                    <td class="py-2 px-4 border">{{$dendaSusutSopir >= 0 ? 'true' : 'false'}}</td>
                </tr>
                @endforeach
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border font-bold">TOTAL</td>
                    <td class="py-2 px-4 border font-bold"></td>
                    <td class="py-2 px-4 border font-bold"></td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalMuat) }}</td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalBongkar) }}</td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalSusut) }}</td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalToleransi) }}</td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalSusutDiatasToleransi) }}</td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalDendaSusutSopir) }}</td>
                    <td class="py-2 px-4 border font-bold">{{ number_format($totalKontribusiTidakSusut) }}</td>
                    <td class="py-2 px-4 border font-bold">{{abs($totalKontribusiBonus) . ' %'}}</td>
                    <td class="py-2 px-4 border font-bold">{{number_format($totalBonusAntarTeman)}}</td>
                </tr>
            </tbody>
        </table>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <tr>
                <td class="py-2 px-4 border">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg ">
                        <tr>
                            <td class="py-2 px-4 border font-bold">TOLERANSI SUSUT TOTAL 0,25%</td>
                            <td class="py-2 px-4 border font-bold">{{ number_format($totalToleransi) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border font-bold">TOTAL SUSUT DIATAS TOLERANSI</td>
                            <td class="py-2 px-4 border font-bold">{{ number_format($totalSusutDiatasToleransi) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border font-bold">DENDA FR</td>
                            <td class="py-2 px-4 border font-bold">{{ '- ' . number_format($dendaFR) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border font-bold">DENDA SUSUT SOPIR</td>
                            <td class="py-2 px-4 border font-bold">{{ number_format($totalDendaSusutSopir) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border font-bold">SISA DENDA SUSUT SOPIR</td>
                            <td class="py-2 px-4 border font-bold">{{ number_format($sisaDenda) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
