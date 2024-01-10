<?php

// app/Helpers/DateHelper.php

if (!function_exists('bulan_to_angka')) {
    /**
     * Mengonversi nama bulan menjadi angka bulan.
     *
     * @param string $bulan Nama bulan dalam bahasa Indonesia.
     * @return int|null Angka bulan atau null jika nama bulan tidak valid.
     */
    function bulan_to_angka($bulan)
    {
        $bulanMapping = [
            'Januari'   => 1,
            'Februari'  => 2,
            'Maret'     => 3,
            'April'     => 4,
            'Mei'       => 5,
            'Juni'      => 6,
            'Juli'      => 7,
            'Agustus'   => 8,
            'September' => 9,
            'Oktober'   => 10,
            'November'  => 11,
            'Desember'  => 12,
        ];

        return $bulanMapping[$bulan] ?? null;
    }
}
