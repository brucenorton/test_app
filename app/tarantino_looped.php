<?php
// Connect to db - $link
require_once "_includes/db_connect.php";

// Prepare the statement passing the db $link and the SQL
$stmt = mysqli_prepare($link,
    "SELECT 
        tarantino_movies.movie, 
        tarantino_movies.year, 
        tarantino_actors.actorsName, 
        tarantino_actors.birthYear, 
        tarantino_actors.biography
      FROM tarantino_movies, tarantino_actors, tarantino_linker
      WHERE tarantino_linker.actorID = tarantino_actors.actorID
      AND tarantino_linker.movieID = tarantino_movies.movieID"
);

/** or use explicit "JOIN ON"  syntax for easier reading **/
/*
$stmt = mysqli_prepare($link,
    "SELECT 
        tarantino_movies.movie, 
        tarantino_movies.year, 
        tarantino_actors.actorsName, 
        tarantino_actors.birthYear, 
        tarantino_actors.biography
    FROM tarantino_movies 
    JOIN tarantino_linker ON tarantino_linker.movieID = tarantino_movies.movieID
    JOIN tarantino_actors ON tarantino_linker.actorID = tarantino_actors.actorID"
);
*/

// Execute the statement / query from above
mysqli_stmt_execute($stmt);

// Get results
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $movie_title = $row['movie'];

    if (!isset($results[$movie_title])) {
        $results[$movie_title] = [
            'movie' => $movie_title,
            'year' => $row['year'],
            'actors' => []
        ];
    }

    $results[$movie_title]['actors'][] = [
        'name' => $row['actorsName'],
        'birthYear' => $row['birthYear'],
        'biography' => $row['biography']
    ];
}

// Encode & display json
echo json_encode($results);

// Close the link to the db
mysqli_close($link);
?>
