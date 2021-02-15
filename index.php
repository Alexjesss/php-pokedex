<?php

if (!isset($_GET['search'])){
    $search = 1;
}
else {
     $search = $_GET['search'];
}

const pokemonApi_url = 'https://pokeapi.co/api/v2/pokemon/';
$pokemon = json_decode(file_get_contents(pokemonApi_url.$search),true);

$speciesApi = json_decode(file_get_contents($pokemon['species']['url']),true);
$evolutionsApi = json_decode(file_get_contents($speciesApi['evolution_chain']['url']),true);

$pokemonImages = isset($pokemon['sprites']['front_default']) ? $pokemon['sprites']['front_default']:'';
$pokemonImage = $pokemonImages;
$pokemonMovesArray = $pokemon['moves'];
$slicedMoves = array_slice($pokemonMovesArray, 0,4);
$pokemonText = $pokemon['name'].'<br>'. 'ID: '.$pokemon['id'].'<br>';

$pokemonEvolutionOne = $evolutionsApi['chain']['species']['name'];
$pokemonEvolutionTwo =  isset($evolutionsApi['chain']['evolves_to'][0]['species']['name']) ? $evolutionsApi['chain']['evolves_to'][0]['species']['name']:null ;
$pokemonEvolutionThree = isset($evolutionsApi['chain']['evolves_to'][0]['evolves_to'][0]['species']['name']) ? $evolutionsApi['chain']['evolves_to'][0]['evolves_to'][0]['species']['name']:null;

   foreach($slicedMoves AS $moves){
       $pokemonText.= $moves['move']['name'].', ';
   }

   if($pokemonEvolutionTwo !== null && $pokemonEvolutionThree == null) {
       $Secondevolution = json_decode(file_get_contents(pokemonApi_url.$pokemonEvolutionTwo),true);
       $pokemonImage2 = isset($Secondevolution['sprites']['front_default']) ? $Secondevolution['sprites']['front_default']:'';
       $Firstevolution = json_decode(file_get_contents(pokemonApi_url.$pokemonEvolutionOne),true);
       $pokemonImage1 = $Firstevolution['sprites']['front_default'];

   }
 elseif($pokemonEvolutionTwo !== null && $pokemonEvolutionThree !== null) {
     $Secondevolution = json_decode(file_get_contents(pokemonApi_url.$pokemonEvolutionTwo),true);
     $pokemonImage2 = isset($Secondevolution['sprites']['front_default']) ? $Secondevolution['sprites']['front_default']:'';
     $Thirdevolution = json_decode(file_get_contents(pokemonApi_url.$pokemonEvolutionThree),true);
     $pokemonImage3 = isset($Thirdevolution['sprites']['front_default']) ? $Thirdevolution['sprites']['front_default']:'';
     $Firstevolution = json_decode(file_get_contents(pokemonApi_url.$pokemonEvolutionOne),true);
     $pokemonImage1 = $Firstevolution['sprites']['front_default'];
 }
else {
    $pokemonImage1 = $pokemon['sprites']['front_default'];
}

$nextPokemon = $pokemon['id'] +1;


if($pokemon['id'] < 1){
    $previousPokemon = 1;
}
else {
    $previousPokemon = $pokemon['id'] -1;
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="pokedex.css" type="text/css">
    <title>Pokedex</title>
</head>
<body>

<!-- POKEDEX START -->

<div class="hoennPokedex">
    <div class="rectangle"></div>
    <div class="inner-rectangle"></div>
    <div class="bottom-rectangle"></div>
    <div class="side1"></div>
    <div class="side2"></div></div>
<div class="side3"></div>
<div class="side4"></div>
<div class="sound"></div>
<div class="sound2"></div>
<div class="sound3"></div>
<div class="sound4"></div>
<div class="screen-bg">
    <div class="background"></div>
    <div id="screen" class="screen">
        <form action="" method="get">
        <input name="search" type="text" id="input">
        </form>
        <img id='sprites' src= '<?php echo $pokemonImage; ?>' alt='pokemonImage'>
        <p><?php echo $pokemonText; ?></p>
        <div class="screen-sides"></div>
    </div>
    <div class="background-button"></div>
    <div class="pokedex-bg-button"></div>
    <div class="button-line"></div>
    <div class="pokedex-bg-button2"></div>
    <form action="" method="get">
    <div id="run" class="pokedex-button" name="run">
    </div>
    </form>
    <div class="deco1">
        <div class="deco-button"></div>
    </div>
    <div class="deco2">
        <div class="deco-button"></div>
    </div>
    <a id ="next" class="next-button" href="http://pokedex.local/?search=<?php echo $nextPokemon;?>"></a>
    <a id ="prev" class="prev-button" href="http://pokedex.local/?search=<?php echo $previousPokemon;?>"></a>
    <div class="switch-button"></div>
    <div id="first-pokemon">
        <img id='sprites' src= '<?php echo $pokemonImage1; ?>' alt='pokemonImage'>
    </div>
    <div id="second-pokemon">
        <img id='sprites' src= '<?php echo $pokemonImage2;?>' alt='pokemonImage'>
    </div>
    <div id="third-pokemon">
        <img id='sprites' src= '<?php echo $pokemonImage3;?>' alt='pokemonImage'>
    </div>
</div>

<!-- POKEDEX END -->

<div class="title">
    <img class="title" src="title.png" alt="pokemon-title">
</div>

</body>
</html>