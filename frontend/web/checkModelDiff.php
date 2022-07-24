<?php
function checkModelDiff($model): array
{
    $newModel = $model->getAttributes();
    $oldModel = $model->getOldAttributes();
    $diff = array_diff_assoc($oldModel, $newModel);
    if (count($diff) > 0) {
        $diff = [];
        foreach ($oldModel as $key => $value) {
            if ($value != $newModel[$key] || ($value == null && $newModel[$key] != null)) {
                $diff[$key] = [
                    'old' => $value,
                    'new' => $newModel[$key],
                ];
            }
        }
        return $diff;
    }
    return [];
}

