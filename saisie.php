<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrôler les données récupérées</title>
</head>
<body>
    <?php

    $arrSaisi = filter_input(
        INPUT_POST,
        'saisie',
        FILTER_DEFAULT,
        FILTER_REQUIRE_ARRAY
    );

    var_dump($_POST); //pour vérifier ce que on a saisi sur la formlulaire
    echo '<br>';

    if(!empty($arrSaisi)){

    //     // Partie 1: Date de naissance_______________________ 
    //     // Validité d’une date - Plage de valeurs
    //     //recuperer les composantes de la date saisie:
        $date_de_naissance = trim($arrSaisi['date_de_naissance']);
         // Solution 1: Avec fonction explode:
        $jma = explode('/',$date_de_naissance);
                //$jma[0] contient le jour 
                //$jma[1] contient le mois 
                //$jma[2] contient l'année
        if(!empty($date_de_naissance)){
            $format_date = '#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#';
            if(!preg_match($format_date,$date_de_naissance,$jma)){echo 'Mauvais format pour la date';} 
            else {
                //checkdate(int $month, int $day, int $year): bool
                if(!checkdate($jma[1],$jma[0],$jma[2])){
                    echo 'Mauvais format pour la date';
                } else {
                        // tester la plage de valeurs
                        // construit sur la forme AAAMMJJ pour JJ/MM/YYYY

                        //Etape 1: Recuperer les composantes de la date
                        list($jour,$mois,$annee) = explode('/',$date_de_naissance);
                        //Etape 2: Contruire une chaine au format AAAAMMJJ
                        $aaaammjj = sprintf('%04d%02d%02d',$annee,$mois,$jour);
                        //Etape 3: Definir les dates mini et maxi selon le meme format
                        $date_mini ='19000101'; //01/01/1900
                        $date_maxi = date('Ymd'); //date du jour // 20220128
                        //Etape 4: Comparer
                        if($aaaammjj<$date_mini or $aaaammjj>$date_maxi){
                        echo 'Date hors de la plage autorisée';
                        }else{  echo 'Date de naissance : '.$date_de_naissance;};
                }; 
            };
        } 
        else {echo 'Date de naissance : inconnue';};    
    // // END: Date de naissance_______________________ 
    // //_______________________ 
   } else { echo 'Donnée inconnues';};
    ?>
</body>
</html>