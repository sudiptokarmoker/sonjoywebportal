<?php
namespace App\Repositories;

use App\Models\Backened\ComposerContactDetailsModel;
use App\Models\Backened\ComposerModel;
use App\Models\Backened\ComposerPersonalDetailsModel;

class ComposerRepository implements ComposerRepositoryInterface
{
    public function save(array $data)
    {
        /**
         * save data
         */
        $composerModelObject = ComposerModel::create([
            'name' => $data['name'],
            'name_in_bangla' => $data['name_in_bangla'],
        ]);
        if ($composerModelObject && $composerModelObject->id) {
            ComposerPersonalDetailsModel::create([
                'composer_id' => $composerModelObject->id,
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
            ]);
            ComposerContactDetailsModel::create([
                'composer_id' => $composerModelObject->id,
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'address_line_one' => $data['address_line_one'],
                'address_line_two' => $data['address_line_two'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
            ]);
        }
        return;
    }

    public function edit($id)
    {
        $item = ComposerModel::findOrFail($id);
        return [
            'id' => $item->id,
            'name' => $item->name,
            'name_in_bangla' => $item->name_in_bangla,
            'email' => $item->composerContactDetails ? $item->composerContactDetails->email : '',
            'mobile' => $item->composerContactDetails ? $item->composerContactDetails->mobile : '',
            'city' => $item->composerContactDetails ? $item->composerContactDetails->city : '',
            'state' => $item->composerContactDetails ? $item->composerContactDetails->state : '',
            'country' => $item->composerContactDetails ? $item->composerContactDetails->country : '',
            'gender' => $item->composerPersonalDetils ? $item->composerPersonalDetils->gender : '',
            'date_of_birth' => $item->composerPersonalDetils ? $item->composerPersonalDetils->date_of_birth : '',
            'address_line_one' => $item->composerContactDetails ? $item->composerContactDetails->address_line_one : '',
            'address_line_two' => $item->composerContactDetails ? $item->composerContactDetails->address_line_two : '',
            'contact_details_id' => $item->composerContactDetails ? $item->composerContactDetails->id : null,
        ];
    }
    // edit
    public function update(array $data, $id)
    {
        $artistsModelObject = ComposerModel::findOrFail($id);
        $artistsModelObject->name = $data['name'];
        $artistsModelObject->name_in_bangla = $data['name_in_bangla'];
        $artistsModelObject->update();
        // update rest part persoanl details and contact details
        ComposerPersonalDetailsModel::where('composer_id', $id)
            ->update(
                [
                    'gender' => $data['gender'],
                    'date_of_birth' => $data['date_of_birth'],
                ]
            );
        ComposerContactDetailsModel::where('composer_id', $id)
            ->update(
                [
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'address_line_one' => $data['address_line_one'],
                    'address_line_two' => $data['address_line_two'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                ]
            );
        return;
    }

    public function delete($id)
    {
        $aritisDeleteObj = ComposerModel::findOrFail($id);
        $aritisDeleteObj->delete();
        // the rest will be delete partially
        return;
    }

    public function all()
    {
        $data = ComposerModel::orderBy("id", "asc")->get();
        return $data;
    }
}
