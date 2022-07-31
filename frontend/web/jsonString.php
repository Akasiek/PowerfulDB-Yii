<?php

use common\models\Artist;
use common\models\Band;
use common\models\Genre;

/**
 * Use if data values are encoded JSON strings.
 * Create a string representation of the data, using their respectful names (for example for artist we use "name" column).
 * Pros are better readability and easier comparison for the user.
 */
function jsonString($model)
{
    if (($model->column === "author_id" && $model->table === "track") || $model->column === "genre_id") {
        $jsonArrays = [
            'new' => json_decode($model->new_data),
            'old' => json_decode($model->old_data)
        ];

        $arrays = ['new' => [], 'old' => []];
        foreach ($jsonArrays as $name => $array) {
            if (isset($array)) {
                foreach ($array as $value) {
                    if ($model->column === 'genre_id') {
                        $arrays[$name][] = Genre::findOne($value)->name;
                    } elseif ($model->column === 'author_id') {
                        $author = explode('-', $value);
                        if ($author[0] === 'artist') {
                            $arrays[$name][] = Artist::findOne($author[1])->name;
                        } else {
                            $arrays[$name][] = Band::findOne($author[1])->name;
                        }
                    }
                }
            } else {
                $arrays[$name][] = "null";
            }
        }
        $jsonString = [
            'new' => implode(', ', $arrays['new']),
            'old' => implode(', ', $arrays['old'])
        ];
        $model->jsonString = $jsonString;
    }
    return $model;
}