<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersAllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // hash de 'frayluisamigo'

        // Desactivamos el auto-incremento temporalmente
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 10;');

        $users = [
            // Personal Docente de Educación Primaria - user_id desde 10
            ['id' => 10, 'name' => 'Escobar Ramirez Yudyth Del Carmen', 'username' => 'escobaryudith501', 'email' => 'yudyth.escobar@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 11, 'name' => 'Garcia Sierra Maribel', 'username' => 'garciamaribel377', 'email' => 'maribel.garcia@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 12, 'name' => 'Puerta Yanez Yvonne Leticia', 'username' => 'puertayvonne801', 'email' => 'yvonne.puerta@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 13, 'name' => 'Bazan Bermudez Agne Cecilia', 'username' => 'bazancecilia862', 'email' => 'cecilia.bazan@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 14, 'name' => 'Dos Santos Carrera Helencleomar', 'username' => 'santoshelencleomar141', 'email' => 'helencleomar.santos@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 15, 'name' => 'Colmenarez Montañez Cecilia Rosa', 'username' => 'colmenarezc763', 'email' => 'cecilia.colmenarez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 16, 'name' => 'Crespo Leon Ada Griselda', 'username' => 'crespogriselda322', 'email' => 'griselda.crespo@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 17, 'name' => 'Vanessa Sanchez', 'username' => 'vanessasanchez770', 'email' => 'vanessa.sanchez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 18, 'name' => 'Rafaela Dominguez', 'username' => 'rafaeladominguez743', 'email' => 'rafaela.dominguez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 19, 'name' => 'Ibranny Oropeza', 'username' => 'ibrannyoropeza348', 'email' => 'ibranny.oropeza@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 20, 'name' => 'Maria D\'Lima', 'username' => 'dlimamaria4137', 'email' => 'maria.dlima@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 21, 'name' => 'Alvarado Urriche Nilinska Yanneth', 'username' => 'alvaradonilinska8396', 'email' => 'nilinska.alvarado@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 22, 'name' => 'Escalona Chirino Yendri Carolina', 'username' => 'escalonyendri9039', 'email' => 'yendri.escalona@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 23, 'name' => 'Castillo Rodriguez Kellimar', 'username' => 'castillokellimar0832', 'email' => 'kellimar.castillo@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 24, 'name' => 'Sequera Lovera Heira Mariel', 'username' => 'sequeramariel6317', 'email' => 'mariel.sequera@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 25, 'name' => 'Tovar Alejos Scarleth Anais', 'username' => 'tovarscarleth5816', 'email' => 'scarleth.tovar@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 26, 'name' => 'Perez Salas Maria Gabriela', 'username' => 'perezgabriela0943', 'email' => 'gabriela.perez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 27, 'name' => 'Van Denker Anne Carolina', 'username' => 'vandekercarolina8288', 'email' => 'anne.vandeker@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 28, 'name' => 'Bazan Guevara Anna Yulianny', 'username' => 'bazaannayulianny9587', 'email' => 'anna.bazan@frayluisamigo.edu.ve', 'password' => $password],

            // Personal Docente de Educación Media General - user_id 29+
            ['id' => 29, 'name' => 'Mendoza Figueira Aura Josefina', 'username' => 'mendozaura5942', 'email' => 'aura.mendoza@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 30, 'name' => 'Mora De Tampoo Isabel Josefina', 'username' => 'moraisabel280', 'email' => 'isabel.mora@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 31, 'name' => 'Cortez Alejos Carmin Andrieina', 'username' => 'cortezcarmin2623', 'email' => 'carmin.cortez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 32, 'name' => 'Camacho Moreno Ysabel Mirelli', 'username' => 'camachoyesabel8521', 'email' => 'ysabel.camacho@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 33, 'name' => 'Rios Deviez Milagros Del Carmen', 'username' => 'riosmilagros4339', 'email' => 'milagros.rios@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 34, 'name' => 'Maldonado Gimenez Victor Hugo', 'username' => 'maldonadovictor0253', 'email' => 'victor.maldonado@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 35, 'name' => 'Marchena Portilla Daniel', 'username' => 'marchenadaniel3362', 'email' => 'daniel.marchena@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 36, 'name' => 'Montilva Hernandez Miguel Angel', 'username' => 'montilvamiguel3337', 'email' => 'miguel.montilva@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 37, 'name' => 'Enrique Segovia', 'username' => 'enriquesegovia2912', 'email' => 'enrique.segovia@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 38, 'name' => 'Moises Ordoñez', 'username' => 'moisesordonez1704', 'email' => 'moises.ordonez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 39, 'name' => 'Alvarez Tania', 'username' => 'alvarezetania5854', 'email' => 'tania.alvarez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 40, 'name' => 'Torres Villalobos Jose Gabriel', 'username' => 'torresjose558', 'email' => 'jose.torres@frayluisamigo.edu.ve', 'password' => $password],

            // Docentes de Inglés - user_id 41+
            ['id' => 41, 'name' => 'Roxangel Rodriguez', 'username' => 'rodriguezroxangel051', 'email' => 'roxangel.rodriguez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 42, 'name' => 'Matos Contreras Narda Maria', 'username' => 'matosnarda3506', 'email' => 'narda.matos@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 43, 'name' => 'Piñero Villegas Alejandra Barbara', 'username' => 'pinerobarbara2726', 'email' => 'barbara.pinero@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 44, 'name' => 'Sanchez Guevara Roberto Andres', 'username' => 'sanchezroberto0260', 'email' => 'roberto.sanchez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 45, 'name' => 'Ordóñez Novello Gabriela Alejandra', 'username' => 'ordonezgabriela8096', 'email' => 'gabriela.ordonez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 46, 'name' => 'Muñoz Galup Jose Delfin', 'username' => 'munozdelfin3718', 'email' => 'delfin.muñoz@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 47, 'name' => 'Berriz Dorante Roderyt Javier', 'username' => 'berrizroderyt2157', 'email' => 'roderyt.berriz@frayluisamigo.edu.ve', 'password' => $password],

            // Dirección y Coordinaciones Académicas - user_id 48+
            ['id' => 48, 'name' => 'Escarleth Lopez De Antolini', 'username' => 'escarlethalopez3218', 'email' => 'escarleth.lopez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 49, 'name' => 'Chacon Colmenarez Rinna Gabriela', 'username' => 'chaconrinna6044', 'email' => 'rinna.chacon@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 50, 'name' => 'Veliz Dudamell Lidoska Beatriz', 'username' => 'velizlidoka5556', 'email' => 'lidiska.veliz@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 51, 'name' => 'Parra Figueroa Harold Alexander', 'username' => 'parraharold4558', 'email' => 'harold.parra@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 52, 'name' => 'Rubinettti Marquez Idalmis Mercedes', 'username' => 'rubinetttiidalmis6416', 'email' => 'idalmis.rubinettti@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 53, 'name' => 'Ortaz De Raban Elizabeth Del Rosario', 'username' => 'ortazelizabeth3047', 'email' => 'elizabeth.ortaz@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 54, 'name' => 'Betancourt Valero Alejandra', 'username' => 'betancourta25267', 'email' => 'alejandra.betancourt@frayluisamigo.edu.ve', 'password' => $password],

            // Bienestar Estudiantil - user_id 55+
            ['id' => 55, 'name' => 'Salas Richard', 'username' => 'salasrichard3521', 'email' => 'richard.salas@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 56, 'name' => 'Emilia Guedez', 'username' => 'emiliaguedez2484', 'email' => 'emilia.guedez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 57, 'name' => 'Marquez Campos Rosa Elena', 'username' => 'marquezrosa6544', 'email' => 'rosa.marquez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 58, 'name' => 'Garrido Lozada Maryangel Mercedes', 'username' => 'garridomary3152', 'email' => 'maryangel.garrido@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 59, 'name' => 'Silva Tesvari Maria', 'username' => 'silvamaria1064', 'email' => 'maria.silva@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 60, 'name' => 'Fernandez Yovera Lenin Alberto', 'username' => 'fernandezlenin0109', 'email' => 'lenin.fernandez@frayluisamigo.edu.ve', 'password' => $password],

            // Personal de Mantenimiento - user_id 61+
            ['id' => 61, 'name' => 'Figuerola De Blanco Australida Josefina', 'username' => 'figuerolajosefina711', 'email' => 'australida.figuerola@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 62, 'name' => 'Rodriguez Gamez Temistocles', 'username' => 'rodrigueztemistocles596', 'email' => 'temistocles.rodriguez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 63, 'name' => 'Anzola Luis Felipe', 'username' => 'anzolaluis3780', 'email' => 'luis.anzola@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 64, 'name' => 'Arenas Nancy Mariela', 'username' => 'arenasnancy4731', 'email' => 'nancy.arenas@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 65, 'name' => 'Parra Guerra Yamileth Yasmin', 'username' => 'parrayamileth3250', 'email' => 'yamileth.parra@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 66, 'name' => 'Montero Camacho Elizabeth', 'username' => 'monteroe_15767557', 'email' => 'elizabeth.montero@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 67, 'name' => 'Marchena Zugeith Coromoto', 'username' => 'marchanzugeith115', 'email' => 'coromoto.marchena@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 68, 'name' => 'Hernandez Coronado Vicente Elias', 'username' => 'hernandezvicente915', 'email' => 'vicente.hernandez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 69, 'name' => 'Escalante Chacon Yolly Suzaida', 'username' => 'escalanteyolly073', 'email' => 'yolly.escalante@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 70, 'name' => 'Salom Azoca Pedro Rafael', 'username' => 'salompedro236', 'email' => 'pedro.salom@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 71, 'name' => 'Lopez Arocha Jose Francisco', 'username' => 'lopezjose313', 'email' => 'jose.lopez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 72, 'name' => 'Espinoza Kenny', 'username' => 'espinozakenny827', 'email' => 'kenny.espinoza@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 73, 'name' => 'Castillo Charlie', 'username' => 'castillocharlie115', 'email' => 'charlie.castillo@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 74, 'name' => 'Moreno Franklin', 'username' => 'morenoeduardo329', 'email' => 'franklin.moreno@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 75, 'name' => 'Jose Miguel Quintero', 'username' => 'quinterojose807', 'email' => 'jose.quintero@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 76, 'name' => 'Alvarez Mendoza Eli Samuel', 'username' => 'alvarezelisamuel837', 'email' => 'eli.alvarez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 77, 'name' => 'Quiroga Salazar Dennys Jesus', 'username' => 'quirogadennys726', 'email' => 'dennys.quiroga@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 78, 'name' => 'Rodriguez Rodriguez Roenis Jose', 'username' => 'rodriguezroenis312', 'email' => 'roenis.rodriguez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 79, 'name' => 'Greisy Paez', 'username' => 'greisypaez8128', 'email' => 'greisy.paez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 80, 'name' => 'Colmenares Osorio Naya Cristina', 'username' => 'colmenaresnaya2128', 'email' => 'naya.colmenares@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 81, 'name' => 'Barrios Ochoa Maria Eneda', 'username' => 'barriosmaria3046', 'email' => 'maria.barrios@frayluisamigo.edu.ve', 'password' => $password],

            // Personal Directivo, Administrativo y Religioso - user_id 82+
            ['id' => 82, 'name' => 'Sierra Rodriguez Ezequiel Jose', 'username' => 'sierraezequiel5888', 'email' => 'ezequiel.sierra@frayluisamigo.edu.ve', 'password' => $password],

            // Personal Administrativo - user_id 81+
            ['id' => 83, 'name' => 'Suarez Clisanches Anaines Elizabeth', 'username' => 'suarezelizabeth787', 'email' => 'elizabeth.suarez@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 84, 'name' => 'Ledezma Valles Yanira', 'username' => 'ledezmayanira9570', 'email' => 'yanira.ledezma@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 85, 'name' => 'Bastidas Montilla Marielys De Jesus', 'username' => 'bastidasmarie5017', 'email' => 'marielys.bastidas@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 86, 'name' => 'Verastegui Lisbeth', 'username' => 'verasteguilisbeth923', 'email' => 'lisbeth.verastegui@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 87, 'name' => 'Jesus Rodriguez', 'username' => 'jesusrodriguez4188', 'email' => 'jesus.rodriguez@frayluisamigo.edu.ve', 'password' => $password],

            // Personal sin cuenta nómina - user_id 86+
            ['id' => 88, 'name' => 'Goitia Gonzalez Ricardo Jose', 'username' => 'goitiaricardo635', 'email' => 'ricardo.goitia@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 89, 'name' => 'Montero Tovar Mabelys Andreina', 'username' => 'monteromabelys7995', 'email' => 'mabelys.montero@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 90, 'name' => 'Rivero Escudero Jose De La Cruz', 'username' => 'riverojose4303', 'email' => 'jose.rivero@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 91, 'name' => 'Mendoza Martinez Felicita Esmelanda', 'username' => 'mendozafelicita5284', 'email' => 'felicita.mendoza@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 92, 'name' => 'Medina Rea Carlos Educardo', 'username' => 'medinacarlos922', 'email' => 'carlos.medina@frayluisamigo.edu.ve', 'password' => $password],
            ['id' => 93, 'name' => 'Brito Dominguez Dolimar', 'username' => 'britodolimar7583', 'email' => 'dolimar.brito@frayluisamigo.edu.ve', 'password' => $password],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['id' => $user['id']],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'email_verified_at' => null,
                    'remember_token' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
