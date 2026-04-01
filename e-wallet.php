<?php
require_once 'Pembayaran.php';
require_once 'cetak.php';

# Penggunaan Class Ewallet
class Ewallet extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Pembayaran E-Wallet Rp {$this->jumlah} berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk E-Wallet: Rp {$this->jumlah}";
    }
}
?>