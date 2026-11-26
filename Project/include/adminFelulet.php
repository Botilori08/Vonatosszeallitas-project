<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-head">
                <h1>Jármű hozzáadása</h1>
                <hr>
            </div> 
            <div class="card-body">
                <form action="<?php echo uri(3);?>" method="post" enctype="multipart/form-data">
                <label>Vasúttársaság</label>
                <select name="kivalaszt" id="tarsasagKivalaszt" class="form-control">
                    <!--<option value="MAV" default>MÁV</option>
                    <option value="GYSEV">GYSEV</option>
                    <option value="OEBB">ÖBB</option>
                    <option value="CD">CD</option>-->
                    <?php 
                        $celUtvonal = 'include/json/*.json';

                        echo $celUtvonal;

                        $fileok = glob($celUtvonal);

                        $optionok = "";

                       for($i = 0; $i < sizeof($fileok); $i++)
                        {
                            $tarsasagNev = str_replace("forras.json", "", substr($fileok[$i], 13));
                            $optionok .= '<option value="'.$tarsasagNev.'">'.$tarsasagNev.'</option>';
                        }

                        echo $optionok;
                    
                    ?>
                </select>
                <label>Járműtípus</label>
                <select name="jarmuTipuskivalaszt" id="jarmuTipuskivalaszt" class="form-control">

                </select> 
                <label>Jármű képe:</label>
                <input type="file" name="kep" class="form-control">
                <button type="submit" class="btn btn-dark mt-2" name="hozzaadas">Jármű hozzáadása</button>
                </form>
            </div>
    </div>
    <div class="row">
    <div class="card mt-4">
            <div class="card-head">
                <h1>Vasúttársaság hozzáadása</h1>
                <hr>
            </div> 
            <div class="card-body">
                <form action="<?php echo uri(3);?>" method="post" enctype="multipart/form-data">
                <label>Társaság neve</label>
                <input type="text" name="tarsasagNev" class="form-control">
                <label>Kategóriák</label>
                <textarea name="kategoriak" placeholder="Add meg a kívánt kategóriákat! Minden kategóriát új sorba írj!" class="form-control" ></textarea>
                <label>A társaság logója</label>
                <input type="file" name="logoMegadott" class="form-control">
                <button type="submit" class="btn btn-dark mt-2" name="tarsasagHozzaad">Társaság hozzáadása</button>
                </form>
            </div>
    </div>
    <div class="row mt-3 mb-5">
        <div class="card">
            <div class="card-head">
                <h1>Kategória hozzáadása</h1>
                <hr>
            </div> 
            <div class="card-body">
                <form action="<?php echo uri(3);?>" method="post" enctype="multipart/form-data">
                <label>Vasúttársaság</label>
                <select name="kivalasztTarsasag" id="tarsasagKivalasztas" class="form-control">
                    <!--<option value="MAV" default>MÁV</option>
                    <option value="GYSEV">GYSEV</option>
                    <option value="OEBB">ÖBB</option>
                    <option value="CD">CD</option>-->
                    <?php 
                        $celUtvonal = 'include/json/*.json';

                        echo $celUtvonal;

                        $fileok = glob($celUtvonal);

                        $optionok = "";

                       for($i = 0; $i < sizeof($fileok); $i++)
                        {
                            $tarsasagNev = str_replace("forras.json", "", substr($fileok[$i], 13));
                            $optionok .= '<option value="'.$tarsasagNev.'">'.$tarsasagNev.'</option>';
                        }

                        echo $optionok;
                    
                    ?>
                </select>
                <label>Kategóriák</label>
                <textarea name="hozzaadandoKategoriak" placeholder="Add meg a hozzáadni kívánt kategóriákat! Minden kategóriát új sorba írj!" class="form-control" ></textarea>
                <button type="submit" class="btn btn-dark mt-2" name="kategoriaHozzaad">Kategória hozzáadása</button>
                </form>
            </div>
    </div>
    </div>
</div>
</div>
</div>

<script>

    let tarsasagKivalaszt = document.getElementById("tarsasagKivalaszt");

    tarsasagKivalaszt.addEventListener("DOMContentLoaded",function() {jsonMegszerez(tarsasagKivalaszt)});

    tarsasagKivalaszt.addEventListener("change",function() {jsonMegszerez(this)});


    let jsonNeve = "";
    let optionNevek = [];

    
    function jsonMegszerez(obj)
    {
        jsonNeve = "include/json/"+obj.value+"forras.json";

        let forras = [];

        let jarmuTipuskivalaszt = document.getElementById("jarmuTipuskivalaszt");
        

        fetch(jsonNeve)
        .then(x => x.json())
        .then(y => 
            {
                forras = y;

                console.log(forras);
                optionNevek = [];
                forras.forEach(e => {
                    optionNevek.push(e.nev);
                });

                console.log(optionNevek);

                jarmuTipuskivalaszt.innerHTML = "";

                optionNevek.forEach(e =>
                {
                let option = document.createElement("option");
                option.value = e;
                option.innerHTML = e;
                jarmuTipuskivalaszt.appendChild(option);

                })
                        
            }
        )
    
    }

</script>

<?php
    
    //phpinfo(32);

    class Jarmutipus
	{
		public $nev;
		public $kepek;

		public function __construct($nev,$kepek)
		{
			$this->$nev = $nev;
			$this->$kepek = $kepek;
		}

	}

    if(isset($_POST["hozzaadas"]))
    {
        $vasuttarsasag = "";
        $jarmutipus = "";
        $kepFajlnev = "";



        if(isset($_POST["kivalaszt"]) && htmlspecialchars($_POST["kivalaszt"]) && $_POST["kivalaszt"] !== "")
        {
            $vasuttarsasag = $_POST["kivalaszt"];
        }
        if(isset($_POST["jarmuTipuskivalaszt"]) && htmlspecialchars($_POST["jarmuTipuskivalaszt"]) && $_POST["jarmuTipuskivalaszt"] !== "")
        {
            $jarmutipus = $_POST["jarmuTipuskivalaszt"];
        }
        if(isset($_POST["jarmuTipuskivalaszt"]) && htmlspecialchars($_POST["jarmuTipuskivalaszt"]))
        {
            $kepFajlnev = $_FILES["kep"];
        }

        if (isset($_FILES["kep"]) && $_FILES["kep"]["error"] === UPLOAD_ERR_OK) 
        {

            $celMappa = "kepek/" . $vasuttarsasag . "/";

            if (!is_dir($celMappa)) {
                mkdir($celMappa, 0777, true);
            }

            $fajlNev = basename($_FILES["kep"]["name"]);
            $celUtvonal = $celMappa . $fajlNev;

            $check = getimagesize($_FILES["kep"]["tmp_name"]);
            if ($check !== false) 
            {

                if (move_uploaded_file($_FILES["kep"]["tmp_name"], $celUtvonal)) 
                {
                    echo "A(z) " . htmlspecialchars($fajlNev) . " nevű fájl feltöltése megtörtént!";
 
                } 
                else 
                {
                    echo "Nem sikerült a feltöltés!";
                }

            } 
            else
            {
                echo "A fájl nem kép.";
            }
        }


        $jsonAdatok = json_decode(file_get_contents("include/json/".$vasuttarsasag."forras.json"));

        //var_dump($jsonAdatok[0]->kepek);

        foreach($jsonAdatok as $elem)
        {
            if($elem -> nev == $jarmutipus)
            {
                $elem -> kepek[] = $fajlNev;
            }
        }

        file_put_contents("include/json/".$vasuttarsasag."forras.json",json_encode($jsonAdatok));


    }

    if(isset($_POST["tarsasagHozzaad"]))
    {
        $nev = "";
        $kategoriak = [];
        $logo = "";

        if(isset($_POST["tarsasagNev"]) && htmlspecialchars($_POST["tarsasagNev"]))
        {
            $nev = $_POST["tarsasagNev"];
        }
        if(isset($_POST["kategoriak"]) && htmlspecialchars($_POST["kategoriak"]))
        {
            $vagas = explode(PHP_EOL,$_POST["kategoriak"]);
            $kategoriak = $vagas;
        }

	

        //var_dump($kategoriak);

		$teljesForras = [];

		for($i = 0;$i < sizeof($kategoriak);$i++)
		{
			$teljesForras[] = ["nev"=>$kategoriak[$i],"kepek"=>[]];
		}


        $file = fopen("include/json/".$nev."forras.json","w");

        fwrite($file,json_encode($teljesForras));

        fclose($file);

        if (isset($_FILES["logoMegadott"]) && $_FILES["logoMegadott"]["error"] === UPLOAD_ERR_OK) 
        {

            $celMappa = "include/logok";

            if (!is_dir($celMappa)) {
                mkdir($celMappa, 0777, true);
            }

            $fajlNev = basename($_FILES["logoMegadott"]["name"]);
            $celUtvonal = $celMappa . $fajlNev;

            $check = getimagesize($_FILES["logoMegadott"]["tmp_name"]);
            if ($check !== false) 
            {

                if (move_uploaded_file($_FILES["logoMegadott"]["tmp_name"], $celUtvonal)) 
                {
                    echo "A(z) " . htmlspecialchars($fajlNev) . " nevű fájl feltöltése megtörtént!";
 
                } 
                else 
                {
                    echo "Nem sikerült a feltöltés!";
                }

            } 
            else
            {
                echo "A fájl nem kép.";
            }
        }


    }

    if(isset($_POST["kategoriaHozzaad"]))
    {
        $vasuttarsasag = "";
        $kategoriak = [];


        if(isset($_POST["kivalasztTarsasag"]) && htmlspecialchars($_POST["kivalasztTarsasag"]) && $_POST["kivalasztTarsasag"] !== "")
        {
            $vasuttarsasag = $_POST["kivalasztTarsasag"];
        }
        
        if(isset($_POST["hozzaadandoKategoriak"]) && htmlspecialchars($_POST["hozzaadandoKategoriak"]))
        {
            $vagas = explode(PHP_EOL,$_POST["hozzaadandoKategoriak"]);
            $kategoriak = $vagas;
        }

        $fileNev = "include/json/".$vasuttarsasag."forras.json";

        if(file_exists($fileNev))
        {
            $content = file_put_contents($fileNev);
            $adatok = json_decode($content,true);

            if(sizeof($adatok) == 0)
            {
                $adatok = [];
            }
        }
        else
        {
            $adatok = [];
        }


        foreach($kategoriak as $egyAdat)
        {
            $adatok[] = ["nev"=>$egyAdat,"kepek"=>[]];
        }



        $forrasString = json_encode($teljesForras);

        fwrite($file,json_encode($teljesForras));

        fclose($file);

        
    }

?>

