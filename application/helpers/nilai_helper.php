<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Konversi nilai angka ke huruf
 */
function konversi_huruf($nilai) {
    if ($nilai >= 80) {
        return 'A';
    } elseif ($nilai >= 70) {
        return 'B';
    } elseif ($nilai >= 60) {
        return 'C';
    } elseif ($nilai >= 50) {
        return 'D';
    } else {
        return 'E';
    }
}

/**
 * Konversi nilai angka ke bobot IPK
 */
function konversi_bobot($nilai) {
    if ($nilai >= 80) {
        return 4.00;
    } elseif ($nilai >= 70) {
        return 3.00;
    } elseif ($nilai >= 60) {
        return 2.00;
    } elseif ($nilai >= 50) {
        return 1.00;
    } else {
        return 0.00;
    }
}
