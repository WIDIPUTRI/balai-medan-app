<?php

if (!function_exists('formatRupiah')) {
    /**
     * Format number to Indonesian Rupiah
     *
     * @param float|int $amount
     * @return string
     */
    function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('formatRupiahInput')) {
    /**
     * Format number for input field (without currency symbol)
     *
     * @param float|int $amount
     * @return string
     */
    function formatRupiahInput($amount)
    {
        return number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('parseRupiah')) {
    /**
     * Parse formatted Rupiah string back to number
     *
     * @param string $formatted
     * @return float
     */
    function parseRupiah($formatted)
    {
        // Remove currency symbol and dots, then convert to float
        $clean = str_replace(['Rp ', '.'], '', $formatted);
        return (float) str_replace(',', '.', $clean);
    }
}