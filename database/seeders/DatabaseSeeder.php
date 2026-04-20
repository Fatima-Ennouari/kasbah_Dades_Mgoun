<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // admin user
        DB::table('users')->insert([
            'name'       => 'Admin Kasbah',
            'email'      => 'admin@kasbah-dades.ma',
            'password'   => Hash::make('admin1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // rooms based on real booking.com data for Kasbah Dades Mgoun
        $rooms = [
            [
                'name'        => 'Chambre Double Vue Rivière',
                'type'        => 'double',
                'price'       => 380.00,
                'capacity'    => 2,
                'view'        => 'river',
                'has_balcony' => true,
                'has_ac'      => true,
                'description' => 'Chambre double spacieuse avec balcon privé donnant sur la rivière Dadès. Équipée d\'une salle de bain privée avec bidet, sèche-cheveux et produits de toilette offerts. La vue sur la rivière et les montagnes rend cette chambre unique.',
                'image'       => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=80',
            ],
            [
                'name'        => 'Chambre Double Vue Montagne',
                'type'        => 'double',
                'price'       => 350.00,
                'capacity'    => 2,
                'view'        => 'mountain',
                'has_balcony' => true,
                'has_ac'      => true,
                'description' => 'Belle chambre double avec vue directe sur le Jbel Mgoun. Décoration berbère traditionnelle avec tapis tissés à la main, murs en tadelakt et mobilier en bois sculpté. Salle de bain privée incluse.',
                'image'       => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
            ],
            [
                'name'        => 'Chambre Familiale Vue Jardin',
                'type'        => 'family',
                'price'       => 550.00,
                'capacity'    => 4,
                'view'        => 'garden',
                'has_balcony' => false,
                'has_ac'      => true,
                'description' => 'Grande chambre familiale pouvant accueillir jusqu\'à 4 personnes. Deux lits doubles, vue sur le jardin fleuri de roses. Parfaite pour les familles qui veulent découvrir la vallée des roses de Kelâat M\'Gouna.',
                'image'       => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
            ],
            [
                'name'        => 'Suite Terrasse Panoramique',
                'type'        => 'suite',
                'price'       => 720.00,
                'capacity'    => 2,
                'view'        => 'mountain',
                'has_balcony' => true,
                'has_ac'      => true,
                'description' => 'Notre suite la plus spacieuse avec accès privatif à la terrasse panoramique. Vue à 360° sur les montagnes du Mgoun et la vallée du Dadès. Salon séparé, grand lit king-size, bain à remous privé et décoration authentique amazighe.',
                'image'       => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=800&q=80',
            ],
            [
                'name'        => 'Chambre Simple Vue Piscine',
                'type'        => 'single',
                'price'       => 280.00,
                'capacity'    => 1,
                'view'        => 'pool',
                'has_balcony' => false,
                'has_ac'      => true,
                'description' => 'Chambre simple confortable avec vue sur notre piscine à eau salée. Idéale pour les voyageurs solos qui explorent les gorges du Dadès. Propre, calme et bien équipée avec salle de bain privée.',
                'image'       => 'https://images.unsplash.com/photo-1505693314120-0d443867891c?w=800&q=80',
            ],
            [
                'name'        => 'Chambre Familiale Vue Rivière',
                'type'        => 'family',
                'price'       => 620.00,
                'capacity'    => 5,
                'view'        => 'river',
                'has_balcony' => true,
                'has_ac'      => true,
                'description' => 'Chambre familiale XL avec balcon sur la rivière Dadès. Trois lits, espace salon, et vue magnifique sur les rochers rouges des gorges. La chambre préférée des grandes familles qui visitent la région.',
                'image'       => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&q=80',
            ],
            [
                'name'        => 'Chambre Double Standard',
                'type'        => 'double',
                'price'       => 310.00,
                'capacity'    => 2,
                'view'        => 'garden',
                'has_balcony' => false,
                'has_ac'      => true,
                'description' => 'Chambre double au style marocain authentique. Vue sur le jardin et la cour intérieure de la kasbah. Salle de bain privée, armoire, sèche-cheveux et produits de toilette inclus. Rapport qualité-prix excellent.',
                'image'       => 'https://images.unsplash.com/photo-1586105251261-72a756497a11?w=800&q=80',
            ],
        ];

        foreach ($rooms as $room) {
            DB::table('rooms')->insert(array_merge($room, [
                'available'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // a few sample reservations
        DB::table('reservations')->insert([
            [
                'client_name'  => 'Hassan Benali',
                'client_email' => 'h.benali@gmail.com',
                'client_phone' => '+212 661 234 567',
                'room_id'      => 1,
                'check_in'     => '2025-07-10',
                'check_out'    => '2025-07-14',
                'num_people'   => 2,
                'notes'        => 'Arrivée tardive prévue vers 22h',
                'status'       => 'confirmed',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'client_name'  => 'Sophie Leblanc',
                'client_email' => 'sophie.lb@gmail.com',
                'client_phone' => '+33 6 12 34 56 78',
                'room_id'      => 4,
                'check_in'     => '2025-07-20',
                'check_out'    => '2025-07-25',
                'num_people'   => 2,
                'notes'        => null,
                'status'       => 'pending',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'client_name'  => 'Mohamed Ait Brahim',
                'client_email' => null,
                'client_phone' => '+212 677 890 123',
                'room_id'      => 3,
                'check_in'     => '2025-08-01',
                'check_out'    => '2025-08-05',
                'num_people'   => 4,
                'notes'        => 'Famille avec 2 enfants',
                'status'       => 'confirmed',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}