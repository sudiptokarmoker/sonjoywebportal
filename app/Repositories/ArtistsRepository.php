<?php
namespace App\Repositories;

use App\Models\Backened\ArtistsContactDetailsModel;
use App\Models\Backened\ArtistsModel;
use App\Models\Backened\ArtistsPersonalDetailsModel;

class ArtistsRepository implements ArtistsRepositoryInterface
{
    public function save(array $data)
    {
        /**
         * save data
         */
        $artistsModelObject = ArtistsModel::create([
            'name' => $data['name'],
            'name_in_bangla' => $data['name_in_bangla'],
        ]);
        if ($artistsModelObject && $artistsModelObject->id) {
            ArtistsPersonalDetailsModel::create([
                'artists_id' => $artistsModelObject->id,
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
            ]);
            ArtistsContactDetailsModel::create([
                'artists_id' => $artistsModelObject->id,
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
        $item = ArtistsModel::findOrFail($id);
        return [
            'id' => $item->id,
            'name' => $item->name,
            'name_in_bangla' => $item->name_in_bangla,
            'email' => $item->artistsContactDetails ? $item->artistsContactDetails->email : '',
            'mobile' => $item->artistsContactDetails ? $item->artistsContactDetails->mobile : '',
            'city' => $item->artistsContactDetails ? $item->artistsContactDetails->city : '',
            'state' => $item->artistsContactDetails ? $item->artistsContactDetails->state : '',
            'country' => $item->artistsContactDetails ? $item->artistsContactDetails->country : '',
            'gender' => $item->artistsPersonalDetils ? $item->artistsPersonalDetils->gender : '',
            'date_of_birth' => $item->artistsPersonalDetils ? $item->artistsPersonalDetils->date_of_birth : '',
            'address_line_one' => $item->artistsContactDetails ? $item->artistsContactDetails->address_line_one : '',
            'address_line_two' => $item->artistsContactDetails ? $item->artistsContactDetails->address_line_two : '',
            'contact_details_id' => $item->artistsContactDetails ? $item->artistsContactDetails->id : null,
        ];
    }
    // edit
    public function update(array $data, $id)
    {
        $artistsModelObject = ArtistsModel::findOrFail($id);
        $artistsModelObject->name = $data['name'];
        $artistsModelObject->name_in_bangla = $data['name_in_bangla'];
        $artistsModelObject->update();
        // update rest part persoanl details and contact details
        ArtistsPersonalDetailsModel::where('artists_id', $id)
            ->update(
                [
                    'gender' => $data['gender'],
                    'date_of_birth' => $data['date_of_birth'],
                ]
            );
        ArtistsContactDetailsModel::where('artists_id', $id)
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
        $aritisDeleteObj = ArtistsModel::findOrFail($id);
        $aritisDeleteObj->delete();
        // the rest will be delete partially
        return;
    }

    public function all()
    {
        $data = ArtistsModel::orderBy("id", "asc")->get();
        return $data;
    }
}
