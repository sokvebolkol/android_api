<?php

use Illuminate\Database\Seeder;
use App\Province;
class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Kampong Cham'=>[
            'Batheay','Chamkar Leu','Cheung Prey','Kampong Cham Municipality','Kampong Siem','Kang Meas','Koh Sotin','Prey Chhor','Srey Santhor','Steung Trang'
        ],
        // 'Phnome Penh'=>[
        //     'Banan','Thma Koul','Battambang Municipality','Bavel','Aek Phnum','Moung Ruessei','Rotanak Mondol','Sangkae','Samlout','Sampov Loun','Phnum Proek','Kamrieng','Koas Krala','Rukhak Kiri'
        // ],
        'Seim Reap'=>[
            'Angkor Chum','Angkor Thom','Banteay Srei','Chi Kraeng','Kralanh','Puok','Prasat Bakong','Siem Reap Municipality','Sout Nikom','Srei Snam','Svay Leu','Varin'
        ],
        'Banteay Meanchey'=>[
            'Mongkol Borey','Phnom Srok','Preah Netr Preah','Ou Chrov','Serei Saophoan Municipality','Thma Puok','Svay Chek','Malai','Poipet Municipality'
        ],
        'Battambang'=>[
            'Banan','Thma Koul','Battambang Municipality','Bavel','Aek Phnum','Moung Ruessei','Rotanak Mondol','Sangkae','Samlout','Sampov Loun','Phnum Proek','Kamrieng','Koas Krala','Rukhak Kiri'
        ],
        'Kampong Chhnang'=>[
            'Baribour','Chol Kiri','Kampong Chhnang Municipality','Kampong Leaeng','Kampong Tralach','Rolea Bier','Sameakki Mean Chey','Tuek Phos'
        ],
        'Kampong Speu'=>[
            'Basedth','Chbar Mon Municipality','Kong Pisei','Aoral','Oudong','Phnom Sruoch','Samraong Tong','Thpong'
        ],
        'Kampong Thom'=>[
            'Baray','Kampong Svay','Steung Saen Municipality','Prasat Balangk','Prasat Sambour','Sandaan','Santuk','Stoung'
        ],
        'Kampot'=>[
            'Angkor Chey','Banteay Meas','Chhouk','Chum Kiri','Dang Tong','Kampong Trach','Tuek Chhou','Kampot Municipality'
        ],
        'Kandal'=>[
            'Kandal Stueng','Kien Svay','Khsach Kandal','Kaoh Thum','Leuk Daek','Lvea Aem','Mukh Kampul','Angk Snuol','Ponhea Lueu','Sang','Ta Khmau Municipality'
        ],
        'Koh Kong'=>[
            'Botum Sakor','Kiri Sakor','Koh Kong','Khemarak Phoumin Municipality','Mondol Seima','Srae Ambel','Thma Bang'
        ],
        'Kratié'=>[
            'Chhloung','Kratié Municipality','Prek Prasab','Sambour','Snuol','Chet Borey'
        ],
        'Mondulkiri'=>[
            'Kaev Seima','Kaoh Nheaek','Ou Reang','Pechr Chenda','Senmonorom Municipality'
        ],
        'Phnom Penh'=>[
            'Chamkar Mon','Doun Penh','Prampir Makara','Tuol Kork','Dangkao','Mean Chey','Russey Keo','Sen Sok','Por Senchey','Chroy Changvar','Prek Pnov','Chbar Ampov'
        ],
        'Preah Vihear'=>[
            'Chey Saen','Chhaeb','Choam Khsant','Kuleaen','Rovieng','Sangkom Thmei','Tbaeng Meanchey','Preah Vihear Municipality'
        ],
        'Prey Veng'=>[
            'Ba Phnum','Kamchay Mear','Kampong Trabaek','Kanhchriech','Me Sang','Peam Chor','Peam Ro','Pea Reang','Preah Sdach','Prey Veng Municipality','Pur Rieng','Sithor Kandal','Svay Antor'
        ],
        'Pursat'=>[
            'Bakan','Kandieng','Krakor','Phnum Kravanh','Pursat Municipality','Veal Veang'
        ],
        'Ratanak Kiri'=>[
            'Andoung Meas','Banlung Municipality','Bar Kaev','Koun Mom','Lumphat','Ou Chum','Ou Ya Dav','Ta Veaeng','Veun Sai'
        ],
        'Preah Sihanouk'=>[
            'Sihanoukville Municipality','Prey Nob','Stueng Hav','Kampong Seila'
        ],
        'Steung Treng'=>[
            'Sesan','Siem Bouk','Siem Pang','Stung Treng Municipality','Thala Barivat','Borei O’Svay Sen Chey'
        ],
        'Svay Rieng'=>[
            'Chanthrea','Kampong Rou','Romdoul','Romeas Haek','Svay Chrom','Svay Rieng Municipality','Svay Theab','Bavet Municipality'
        ],
        'Takéo'=>[
            'Angkor Borei','Bati','Bourei Cholsar','Kiri Vong','Koh Andaet','Prey Kabbas','Samraŏng','Doun Kaev Municipality','Tram Kak','Treang'
        ],
        'Oddar Meanchey'=>[
            'Anlong Veng','Banteay Ampil','Chong Kal','Samraong Municipality','Trapeang Prasat'
        ],
        'Kep'=>[
            'Damnak Changaeur','Kep Municipality'
        ],
        'Pailin'=>[
            'Pailin Municipality','Sala Krau'
        ],
        'Tboung Khmum'=>[
            'Dambae','Krouch Chhmar','Memot','Ou Reang Ov','Ponhea Kraek','Tboung Khmum','Suong Municipality'
        ]];

        $provinces = array_keys($array);

        foreach ($provinces as $province){
            $districts = $array[$province];
            foreach($districts as $district){
                DB::table('districts')->insert([
                    'district_name'=>$district,
                    'province_id'=> Province::where('province_name', $province)->first()->id
                    ]);
            }
        }
    }

}
