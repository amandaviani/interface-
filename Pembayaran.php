<?php
abstract class Pembayaran
{
    protected $jumlah;
    protected $diskon;
    protected $pajak;
    protected $totalBayar;

    public function __construct($jumlah)
    {
        $this->jumlah = $jumlah;

        $this->diskon = $jumlah * 0.10;
        $hargaSetelahDiskon = $jumlah - $this->diskon;
        $this->pajak = $hargaSetelahDiskon * 0.11;
        $this->totalBayar = $hargaSetelahDiskon + $this->pajak;
    }

    // method wajib
    abstract public function prosesPembayaran();

    // method umum
    public function validasi()
    {
        return $this->jumlah > 0;
    }
}
