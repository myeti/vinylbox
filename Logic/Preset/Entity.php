<?php

namespace My\Logic\Preset;

use Craft\Box\Flash;
use Craft\Error\Abort;
use \stdClass as YourModel;


/**
 * Replace 'YourModel' with your Model
 * and 'entity' | 'entities' with your alias name
 */
class Entity
{

    /**
     * Get all items
     * @render views\entity.all
     * @return array
     */
    public function all()
    {
        $items = YourModel::all();
        return ['entities' => $items];
    }


    /**
     * Get one item
     * @render views\entity.one
     * @param  string $id
     * @throws \Craft\Error\Abort
     * @return array
     */
    public function one($id)
    {
        // get entity
        $item = YourModel::one($id);

        // does not exist
        if(!$item) {
            throw new Abort('Entity #' . $id .' not found.', 404);
        }

        return ['entity' => $item];
    }


    /**
     * Create or edit entity
     * @param null $id
     * @throws \Craft\Error\Abort
     * @render views/entity.form
     * @return array
     */
    public function form($id = null)
    {
        // get entity
        $model = $id ? YourModel::one($id) : new YourModel();

        // does not exist
        if($id and !$model) {
            throw new Abort('Entity #' . $id .' not found.', 404);
        }
        // form attempt
        elseif($data = post()) {

            // save
            $model = hydrate($model, $data);
            YourModel::save($model);

            // success
            Flash::set('form.success', $id ? 'entity updated.' : 'entity created.');
            go('/entity/', $model->id);

        }

        return ['model' => $model];
    }

    /**
     * Delete item
     * @render views\entity.delete
     * @param  string $id
     */
    public function delete($id)
    {
        YourModel::drop($id);
    }

} 