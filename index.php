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

$pokemonEvolutionOne = $speciesApi["evolves_to"][0];
$pokemonEvolutionTwo = $evolutionsApi['chain']['evolves_from_species'][0];
$pokemonEvolutionThree = $evolutionsApi['chain']['evolves_from_species'][1];

   foreach($slicedMoves AS $moves){
       $pokemonText.= $moves['move']['name'].', ';
   }

   <?php if(empty($pokemonEvolutionTwo)): ?>
  /*$first_condition is true*/ echo <div id="second-pokemon">""</div>;
<?php elseif ($second_condition): ?>
  /*$first_condition is false and $second_condition is true*/echo $pokemon['sprites']['front_default'];
<?php else: ?>
  /*$first_condition and $second_condition are false*/
<?php endif; ?>



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
    <div id="run" class="pokedex-button">
    </div>
    <div class="deco1">
        <div class="deco-button"></div>
    </div>
    <div class="deco2">
        <div class="deco-button"></div>
    </div>
    <div id ="next" class="next-button"></div>
    <div id ="prev" class="prev-button"></div>
    <div class="switch-button"></div>
    <div id="first-pokemon"></div>
    <?php echo $pokemonEvolutionOne.$pokemonImage;?>
    <div id="second-pokemon">
        <?php echo $pokemonEvolutionTwo.$pokemonImage;?>
    </div>
    <div id="third-pokemon">
        <?php echo $pokemonEvolutionThree.$pokemonImage;?>
    </div>
</div>

<!-- POKEDEX END -->

<div class="title">
    <img class="title" src="title.png" alt="pokemon-title">
</div>

</body>
</html>