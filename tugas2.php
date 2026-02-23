<?php
// Membuat class PersegiPanjang
class PersegiPanjang {
    // Property
    public $panjang;
    public $lebar;

    // Constructor (opsional, untuk mengisi nilai awal)
    public function __construct($panjang, $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    // Method hitung luas
    public function hitungLuas() {
        return $this->panjang * $this->lebar;
    }

    // Method hitung keliling
    public function hitungKeliling() {
        return 2 * ($this->panjang + $this->lebar);
    }
}

// Membuat object dengan nilai:
// panjang = 10
// lebar = 5
$pp = new PersegiPanjang(10, 5);

// Menampilkan hasil
echo "Panjang : " . $pp->panjang . "<br>";
echo "Lebar : " . $pp->lebar . "<br>";
echo "Luas : " . $pp->hitungLuas() . "<br>";
echo "Keliling : " . $pp->hitungKeliling();
?>