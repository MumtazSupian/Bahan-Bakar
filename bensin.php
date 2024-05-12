<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bahan Bakar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <h1>Shell</h1>

    <?php
    class Shell {
        private $harga;
        private $jenis;
        private $ppn;
    
        public function __construct($harga, $jenis, $ppn) {
            $this->harga = $harga;
            $this->jenis = $jenis;
            $this->ppn = $ppn;
        }
    
        public function getHarga() {
            return $this->harga;
        }
    
        public function getJenis() {
            return $this->jenis;
        }
    
        public function getPpn() {
            return $this->ppn;
        }
    }
    
    class Beli extends Shell {
        private $jumlah;
        private $totalBayar;
        public $jumlahLiter;
    
        public function __construct($harga, $jenis, $ppn, $jumlah) {
            parent::__construct($harga, $jenis, $ppn);
            $this->jumlah = $jumlah;
            $this->totalBayar = $this->calculateTotalBayar();
        }
    
        private function calculateTotalBayar() {
            $hargaPerLiter = $this->getHarga();
            $this->jumlahLiter = $this->jumlah;
            $ppnPercentage = $this->getPpn() / 100;
            $subTotal = $hargaPerLiter * $this->jumlahLiter;
            $ppnAmount = $subTotal * $ppnPercentage;
            $totalBayar = $subTotal + $ppnAmount;
            return $totalBayar;
        }
    
        public function getTotalBayar() {
            return $this->totalBayar;
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jenisBahanBakar = $_POST["tipeBahanBakar"];
        $jumlahLiter = $_POST["jumlahLiter"];
    
        $harga = 0;
        $ppn = 10;
    
        switch ($jenisBahanBakar) {
            case "Shell Super":
                $harga = 15420;
                break;
            case "SVPowerDiesel":
                $harga = 18310;
                break;
            case "V-Power":
                $harga = 16130;
                break;
            case "V-Power Nitro":
                $harga = 16510;
                break;
        }
    
        $beli = new Beli($harga, $jenisBahanBakar, $ppn, $jumlahLiter);
      
        echo "-------------------------------------------<br>";
        echo "Anda membeli bahan bakar minyak tipe ". $beli->getJenis(). "<br> Dengan jumlah : ". $beli->jumlahLiter. " Liter<br>";
        echo "Total yang harus anda bayar : Rp. ". number_format($beli->getTotalBayar(), 2, '.', ','). "<br>";
        echo "-------------------------------------------<br>";
    }
    ?>

    <form action="" method="post" class="row g-3">
      <div class="col-md-6">
        <label for="jumlahLiter" class="form-label">Masukkan Jumlah Liter:</label>
        <input type="number" class="form-control" id="jumlahLiter" name="jumlahLiter" required>
      </div>
      <div class="col-md-6">
        <label for="tipeBahanBakar" class="form-label">Pilih Tipe Bahan Bakar:</label>
        <select class="form-select" id="tipeBahanBakar" name="tipeBahanBakar" required>
          <option value="Shell Super">Shell Super</option>
          <option value="SVPowerDiesel">SVPowerDiesel</option>
          <option value="V-Power">V-Power</option>
          <option value="V-Power Nitro">V-Power Nitro</option>
        </select>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Beli</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
