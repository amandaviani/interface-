<?php
require_once 'Pembayaran.php';
require_once 'Cetak.php';

class TransferBank extends Pembayaran implements Cetak
{
    public function prosesPembayaran()
    {
        if ($this->validasi()) {
            return "Pembayaran Transfer Bank berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk()
    {
        return "Struk Transfer Bank <br> 
                Nominal Awal: Rp " . number_format($this->jumlah, 0, ',', '.') . " <br> 
                Diskon 10%: Rp " . number_format($this->diskon, 0, ',', '.') . " <br> 
                Pajak 11%: Rp " . number_format($this->pajak, 0, ',', '.') . " <br> 
                <b>Total Bayar: Rp " . number_format($this->totalBayar, 0, ',', '.') . "</b>";
    }
}
