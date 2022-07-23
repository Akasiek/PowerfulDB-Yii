<?php
function checkModelDifference($oldModel, $newModel)
{
    $diff = array_diff_assoc($oldModel->attributes, $newModel->attributes);
    if (count($diff) > 0) {
        $diff = [];
        foreach ($oldModel->attributes as $key => $value) {
            if ($oldModel->{$key} != $newModel->{$key}) {
                $diff[$key] = [
                    'old' => $oldModel->{$key},
                    'new' => $newModel->{$key},
                ];
            }
        }
        return $diff;
    }
    return false;
}

