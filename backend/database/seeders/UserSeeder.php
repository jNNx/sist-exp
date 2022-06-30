<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$persona = Persona::create([
            'dni' => '11222333',
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'telefono' => '3794 112233',
            'email' => 'empleado@example.com',
            'direccion' => '',
        ]);
        //Empleado Administrador Area SECRETARIA GENERAL ADMINISTRATIVA
        User::create([
            'persona_id' => $persona->id,
            'cuil'=>'20'.$persona->dni.'4',
            'tipo_user_id' => 1,
            'area_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $persona = Persona::create([
            'dni' => '21928192',
            'nombre' => 'Marta Mabel',
            'apellido' => 'Perez',
            'telefono' => '3794 112233',
            'email' => 'empleado2@example.com',
            'direccion' => '',
        ]);


        //Empleado Administrador Area Mesa Entrada
        User::create([
            'persona_id' => $persona->id,
            'cuil'=>'20'.$persona->dni.'0',
            'tipo_user_id' => 1,
            'area_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $persona = Persona::create([
            'dni' => '23742249',
            'nombre' => 'Jose Antonio',
            'apellido' => 'Terraes',
            'telefono' => '3794 112233',
            'email' => 'empleado5@example.com',
            'direccion' => '',
        ]);

        //Empleado SubArea : Dpto. MESA DE ENTRADAS Y SALIDAS
        User::create([
            'persona_id' => $persona->id,
            'cuil'=>'27'.$persona->dni.'2',
            'tipo_user_id' => 2,
            'area_id' => 13,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $persona = Persona::create([
        'dni' => '10123455',
        'nombre' => 'Ramon',
        'apellido' => 'Fernandez',
        'telefono' => '3794 112233',
        'email' => 'empleado4@example.com',
        'direccion' => '',
    ]);

    //Empleado SubArea : Dpto. CONTABLE
    User::create([
        'persona_id' => $persona->id,
        'cuil'=>'20'.$persona->dni.'4',
        'tipo_user_id' => 2,
        'area_id' => 8,
        'email_verified_at' => now(),
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(10),
    ]);*/
        /*$users = User::all();
        foreach ($users as $user) {
            $user->password=  Hash::make($user->cuil);
            $user->update();
        }*/

        DB::insert("INSERT INTO tribunaldecuentas.personas (dni,nombre,apellido,telefono,email,direccion,created_at,updated_at) VALUES
        (20087602,'Laura Cristina ','Vischi',NULL,NULL,NULL,NULL,NULL),
        (24257978,'Maria Daniela','Buzzi Decleva',NULL,NULL,NULL,NULL,NULL),
        (25361825,'Mercedes','Roca ',NULL,NULL,NULL,NULL,NULL),
        (33291204,'Karen Tamara Maribel','Garay ',NULL,NULL,NULL,NULL,NULL),
        (20396969,'Barnatan','Gladis Mirta',NULL,NULL,NULL,NULL,NULL),
        (32802224,'Georgina','Vaccaro',NULL,NULL,NULL,NULL,NULL),
        (34569096,'Abrazian Rodrigo','Imanol ',NULL,NULL,NULL,NULL,NULL),
        (28202263,'Gane','Cristian Alejandro ',NULL,NULL,NULL,NULL,NULL),
        (25461805,'Luis Ariel','Bressan',NULL,NULL,NULL,NULL,NULL),
        (26576285,'Patricia Veronica','Macchia ',NULL,NULL,NULL,NULL,NULL),
        (34425592,'Maria Florencia','Vignolo',NULL,NULL,NULL,NULL,NULL),
        (36304313,'Sofia','Heine ',NULL,NULL,NULL,NULL,NULL),
        (20183358,'Norma Beatriz','Mendoza',NULL,NULL,NULL,NULL,NULL),
        (13517833,'Estela Beatriz ','Sosa',NULL,NULL,NULL,NULL,NULL),
        (27295937,'Gustavo Jorge','Villordo',NULL,NULL,NULL,NULL,NULL),
        (27395988,'Leandro Ariel','Vanasco',NULL,NULL,NULL,NULL,NULL),
        (16141302,'Olga Graciela','Hirdes ',NULL,NULL,NULL,NULL,NULL),
        (13637481,'Griselda Emilce','Sanchez Navarro ',NULL,NULL,NULL,NULL,NULL),
        (26847163,'Laura Carina','Minchoff ',NULL,NULL,NULL,NULL,NULL),
        (33214915,'Andrea Mariel','Peralta ',NULL,NULL,NULL,NULL,NULL),
        (29767782,'Maria De Los Angeles','Pacios ',NULL,NULL,NULL,NULL,NULL),
        (18296003,'Sergio Augusto','Monzon ',NULL,NULL,NULL,NULL,NULL),
        (14827402,'Omar Guillermo','Steinbach ',NULL,NULL,NULL,NULL,NULL),
        (17147414,'Erasmo','Maidana',NULL,NULL,NULL,NULL,NULL),
        (18133789,'Alejandro Felipe','Parodi ',NULL,NULL,NULL,NULL,NULL),
        (37391339,'Elias Roberto','Ortiz ',NULL,NULL,NULL,NULL,NULL),
        (34093367,'Mercedes Alejandra','Zorzoli',NULL,NULL,NULL,NULL,NULL),
        (30257391,'Juan Martin','Cemborain ',NULL,NULL,NULL,NULL,NULL),
        (30216156,'Pablo Javier','Ayala ',NULL,NULL,NULL,NULL,NULL),
        (17248051,'Celina Lilian','Sosa ',NULL,NULL,NULL,NULL,NULL),
        (25330601,'Mauricio Nicolas','Barrios ',NULL,NULL,NULL,NULL,NULL),
        (27358086,'Analia ','Gonzalez',NULL,NULL,NULL,NULL,NULL),
        (26680596,'Pablo Sebastian','Higa ',NULL,NULL,NULL,NULL,NULL),
        (18475885,'Lisandro Alberto','Perez ',NULL,NULL,NULL,NULL,NULL),
        (22019776,'Mariano Ramon','Blanco ',NULL,NULL,NULL,NULL,NULL),
        (23742249,'Jose Antonio','Terraes ',NULL,NULL,NULL,NULL,NULL),
        (21928192,'Marta Mabel','Perez ',NULL,NULL,NULL,NULL,NULL),
        (29640839,'Cecilia Elizabet','Caceres ',NULL,NULL,NULL,NULL,NULL),
        (29035533,'Mariano Gabriel','Paredes ',NULL,NULL,NULL,NULL,NULL),
        (37183098,'Gabriel','Casaro Lodoli Gonzalo ',NULL,NULL,NULL,NULL,NULL),
        (30217100,'Hugo Luis','Villan',NULL,NULL,NULL,NULL,NULL),
        (31585773,'Cesar Benjamin','Haberkon ',NULL,NULL,NULL,NULL,NULL),
        (28177596,'Renata Belen','Elias',NULL,NULL,NULL,NULL,NULL),
        (14028286,'Olga Ester','Rolon ',NULL,NULL,NULL,NULL,NULL),
        (34973023,'Gustavo Andres','Pyrohiw Lopez ',NULL,NULL,NULL,NULL,NULL),
        (24045604,'Maria Laura','Collantes',NULL,NULL,NULL,NULL,NULL),
        (40817195,'Santiago','Meza Tanara',NULL,NULL,NULL,NULL,NULL),
        (26396195,'Diego Anibal','Midon ',NULL,NULL,NULL,NULL,NULL),
        (29035501,'Pablo Martin','Laprovitta ',NULL,NULL,NULL,NULL,NULL),
        (27482113,'Angelina','Itikin Roch ',NULL,NULL,NULL,NULL,NULL),
        (21905390,'Jorge Fernando ','Roldan ',NULL,NULL,NULL,NULL,NULL),
        (21134092,'Leonardo Ruben','Gonzalez ',NULL,NULL,NULL,NULL,NULL),
        (26847457,'Cinthia Elizabeth','Galarza ',NULL,NULL,NULL,NULL,NULL),
        (13516197,'Antonio Eugenio','Escalante ',NULL,NULL,NULL,NULL,NULL),
        (25274174,'Ramon Eduardo','Benitez ',NULL,NULL,NULL,NULL,NULL),
        (30424478,'Francisco Natividad','Gimenez ',NULL,NULL,NULL,NULL,NULL),
        (25876990,'Patricia Mabel','Acevedo ',NULL,NULL,NULL,NULL,NULL),
        (24046607,'Maximiliano Alejo','Solari Bacchio ',NULL,NULL,NULL,NULL,NULL),
        (26645169,'Pablo Nicolas','Galarza ',NULL,NULL,NULL,NULL,NULL),
        (17814092,'Juan Ramon','Vallejos ',NULL,NULL,NULL,NULL,NULL),
        (27893070,'Adriana  Vanessa','Garcia ',NULL,NULL,NULL,NULL,NULL),
        (27307078,'Juan Antonio','Rugolotto ',NULL,NULL,NULL,NULL,NULL),
        (36548145,'Jorge Isaac','Ortiz',NULL,NULL,NULL,NULL,NULL),
        (21928733,'Luis Maria','Sigel ',NULL,NULL,NULL,NULL,NULL),
        (37891968,'Florencia Sara ','Torrent  ',NULL,NULL,NULL,NULL,NULL),
        (18418950,'Edgardo Fabian','Ramirez',NULL,NULL,NULL,NULL,NULL),
        (32802379,'Cecilia Natalia','Rodriguez  ',NULL,NULL,NULL,NULL,NULL),
        (25876714,'Andrea Silvina','Delvecchio ',NULL,NULL,NULL,NULL,NULL),
        (21928579,'Alida Leonor','Jara De Luque ',NULL,NULL,NULL,NULL,NULL),
        (28302778,'Vanesa Veronica','Rausch ',NULL,NULL,NULL,NULL,NULL),
        (17412261,'Ruben Alfredo','Ojeda',NULL,NULL,NULL,NULL,NULL),
        (16141091,'Lidia Victoria','Pyrohiw ',NULL,NULL,NULL,NULL,NULL),
        (17813328,'Alicia Antonia','Sandoval ',NULL,NULL,NULL,NULL,NULL),
        (29618865,'Lia Del Carmen','Urresti ',NULL,NULL,NULL,NULL,NULL),
        (38715323,'Camila Celeste','Gonzalez ',NULL,NULL,NULL,NULL,NULL),
        (29803329,'Francisco Alberto','Gutierrez ',NULL,NULL,NULL,NULL,NULL),
        (37698064,'Maria Virginia','Pucciarello ',NULL,NULL,NULL,NULL,NULL),
        (37394196,'Florencia Sabrina','Salvatierra ',NULL,NULL,NULL,NULL,NULL),
        (37157640,'Juan Exequiel','Vallejos ',NULL,NULL,NULL,NULL,NULL),
        (21568010,'Maria Marinella','Buzzi Decleva ',NULL,NULL,NULL,NULL,NULL),
        (26860684,'Sandra Elizabeth','Sendra ',NULL,NULL,NULL,NULL,NULL),
        (20939813,'Sandra Carolina','Marecos ',NULL,NULL,NULL,NULL,NULL),
        (29270309,'Cynthia Paola','Golinski ',NULL,NULL,NULL,NULL,NULL),
        (32516883,'Ileana','Zibecchi ',NULL,NULL,NULL,NULL,NULL),
        (36025680,'Maria Ines','Machado ',NULL,NULL,NULL,NULL,NULL),
        (27038852,'Noelia Alejandra','Salmon ',NULL,NULL,NULL,NULL,NULL),
        (7885102,'Jorge Osiris','Galarza ',NULL,NULL,NULL,NULL,NULL),
        (33636480,'Julio Leandro','Benitez Romero ',NULL,NULL,NULL,NULL,NULL),
        (30111341,'Maria Laura','Matto',NULL,NULL,NULL,NULL,NULL),
        (30710060,'Silvina Mariel','Arrua',NULL,NULL,NULL,NULL,NULL),
        (22019303,'Alejandra Edith ','Escobar',NULL,NULL,NULL,NULL,NULL),
        (25534938,'Emilio Carlos Alberto','Corona Lencina',NULL,NULL,NULL,NULL,NULL),
        (32306334,'Veronica Gisela','Ivan',NULL,NULL,NULL,NULL,NULL),
        (25876495,'Teresa De Jesus ','Del Valle',NULL,NULL,NULL,NULL,NULL),
        (38317029,'Ian Mauricio','Czachurski ',NULL,NULL,NULL,NULL,NULL),
        (29796848,'Raul Esteban','Agnesio ',NULL,NULL,NULL,NULL,NULL),
        (22927264,'Sonia Elizabeth','Duarte ',NULL,NULL,NULL,NULL,NULL),
        (24257718,'Nazareth','Iriondo Rasmussen',NULL,NULL,NULL,NULL,NULL),
        (29571415,'Maria Amalia','Navarret',NULL,NULL,NULL,NULL,NULL),
        (36548085,'Camozzi Juliana','Gomez',NULL,NULL,NULL,NULL,NULL),
        (21734218,'Jose Luis Maria','Ramirez Alegre ',NULL,NULL,NULL,NULL,NULL),
        (28302428,'Guadalupe','Altube ',NULL,NULL,NULL,NULL,NULL),
        (28201225,'Jose Rafael','Vallejos ',NULL,NULL,NULL,NULL,NULL),
        (17767557,'Raquel Maria Beatriz','Seniquiel ',NULL,NULL,NULL,NULL,NULL),
        (22937554,'Claudia Carolina','Simonetti',NULL,NULL,NULL,NULL,NULL),
        (25461970,'Maria Cecilia','Ratier',NULL,NULL,NULL,NULL,NULL),
        (16646873,'Mirta Beatriz ','Eguia',NULL,NULL,NULL,NULL,NULL),
        (28089161,'Cinthya Natalia','Benitez',NULL,NULL,NULL,NULL,NULL),
        (33418418,'Lisandro Jose','Desimoni',NULL,NULL,NULL,NULL,NULL),
        (30216379,'Agustin','Alba Posse',NULL,NULL,NULL,NULL,NULL),
        (28088856,'Diego Adriano','Rolni',NULL,NULL,NULL,NULL,NULL),
        (32992901,'Matias Nicolas','Alegre',NULL,NULL,NULL,NULL,NULL),
        (29323781,'Facundo Manuel','Lago',NULL,NULL,NULL,NULL,NULL),
        (23076086,'Alejandro Maximiliano','Segovia Alvarez ',NULL,NULL,NULL,NULL,NULL),
        (32516827,'Ivana Gabriela','Modenutti',NULL,NULL,NULL,NULL,NULL)");

        DB::insert("INSERT INTO tribunaldecuentas.users (persona_id,area_id,tipo_user_id,cuil,two_factor_secret,two_factor_recovery_codes,email_verified_at,remember_token,created_at,updated_at,deleted_at) VALUES
        (1,24,1,23200876024,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:16',NULL),
        (2,24,2,27242579785,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:16',NULL),
        (3,24,2,27253618251,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:16',NULL),
        (4,24,2,27332912041,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:16',NULL),
        (5,2,1,23203969694,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:16',NULL),
        (6,2,2,24328022245,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:16',NULL),
        (7,2,2,20345690965,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (8,2,2,20282022630,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (9,1,1,20254618056,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (10,1,2,27265762854,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (11,1,2,27344255925,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (12,1,2,27363043130,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (13,5,1,27201833588,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (14,5,2,27135178336,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (15,5,2,20272959375,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (16,5,2,20273959883,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (17,4,1,27161413025,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (18,4,2,27136374813,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (19,4,2,24268471630,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (20,4,2,27332149151,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (21,4,2,27297677824,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (22,6,1,23182960039,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (23,6,2,23148274029,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (24,6,2,20171474141,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (25,6,2,20181337894,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:17',NULL),
        (26,6,2,20373913392,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (27,6,2,27340933678,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (28,15,1,20302573914,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (29,15,2,23302161569,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (30,14,1,27172480514,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (31,14,2,20253306018,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (32,14,2,27273580862,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (33,14,2,23266805969,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (34,14,2,20184758858,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (35,14,2,20220197760,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (36,13,1,20237422490,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (37,13,2,27219281922,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (38,13,2,27296408390,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (39,13,2,20290355339,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (40,13,2,20371830988,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (41,13,2,23302171009,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (42,11,1,20315857733,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (43,11,2,27281775966,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:18',NULL),
        (44,11,2,27140282869,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (45,11,2,20349730236,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (46,11,2,23240456044,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (47,11,2,20408171955,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (48,3,1,20263961952,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (49,3,2,20290355010,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (50,12,2,27274821138,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (51,12,2,20219053909,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (52,12,2,20211340925,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (53,25,2,27268474574,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (54,25,2,20135161978,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (55,25,2,20252741748,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (56,25,2,20304244780,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (57,25,2,27258769908,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (58,7,1,20240466075,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (59,7,2,20266451696,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (60,16,1,20178140923,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (61,16,2,27278930705,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:19',NULL),
        (62,16,2,20273070789,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (63,16,2,20365481459,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (64,16,2,20219287330,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (65,16,2,27378919687,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (66,20,1,20184189500,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (67,20,2,27328023798,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (68,20,2,23258767144,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (69,20,2,27219285790,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (70,20,2,27283027789,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (71,8,1,20174122610,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (72,8,2,27161410913,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (73,17,1,23178133284,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (74,17,2,23296188654,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (75,17,2,27387153239,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (76,17,2,20298033292,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (77,17,2,27376980648,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (78,17,2,23373941964,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:20',NULL),
        (79,17,2,20371576402,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (80,21,1,27215680105,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (81,21,2,27268606845,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (82,21,2,27209398139,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (83,21,2,27292703096,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (84,21,2,27325168833,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (85,21,2,23360256804,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (86,21,2,27270388529,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (87,9,1,20078851024,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (88,9,2,23336364809,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (89,18,1,27301113418,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (90,18,2,27307100601,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (91,18,2,27220193034,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (92,18,2,20255349385,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (93,18,2,27323063341,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (94,18,2,27258764954,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (95,18,2,20383170290,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (96,22,1,20297968484,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (97,22,2,27229272646,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:21',NULL),
        (98,22,2,27242577189,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (99,22,2,27295714153,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (100,22,2,27365480856,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (101,10,1,20217342180,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (102,10,2,27283024283,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (103,10,2,20282012252,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (104,19,1,27177675577,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (105,19,2,27229375542,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (106,19,2,27254619707,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (107,19,2,27166468731,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (108,19,2,23280891614,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (109,19,2,20334184189,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (110,19,2,20302163791,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (111,23,1,20280888568,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (112,23,2,23329929019,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (113,23,2,20293237817,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (114,23,2,20230760862,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL),
        (115,23,2,27325168272,NULL,NULL,NULL,NULL,NULL,'2021-11-09 13:20:22',NULL)");

        $users = User::all();
        foreach ($users as $user) 
        {
            $user->password=  Hash::make($user->cuil);
            $user->update();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->required()->change();
        });
    }
}
