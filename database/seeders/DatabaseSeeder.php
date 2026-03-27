<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $today     = now()->toDateString();
        $tomorrow  = now()->addDay()->toDateString();
        $in3       = now()->addDays(3)->toDateString();
        $in7       = now()->addDays(7)->toDateString();
        $in10      = now()->addDays(10)->toDateString();
        $ago2      = now()->subDays(2)->toDateString();
        $ago5      = now()->subDays(5)->toDateString();

        // ─── USERS ───────────────────────────────────────────────────────────
        if (DB::table('users')->count() === 0) {
            DB::table('users')->insert([
                // ── Admin ────────────────────────────────────────────────────
                [
                    'name'       => 'Carlos Martínez',
                    'email'      => 'admin@empresa.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'admin',
                    'department' => 'Dirección',
                    'position'   => 'Director General',
                    'phone'      => '600 000 001',
                    'birthday'   => '1985-03-15',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                // ── Empleados (importados desde listado de personal) ──────────
                [
                    'name'       => 'Ane Iturriaga Igarza',
                    'email'      => 'administracion@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Administración - RRHH',
                    'position'   => 'Administración - RRHH',
                    'phone'      => null,
                    'birthday'   => '1971-05-15',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Lourdes Susilla Peña',
                    'email'      => 'l.susilla@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Comercial - HEF',
                    'position'   => 'Comercial - HEF',
                    'phone'      => null,
                    'birthday'   => '1971-10-19',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Tania Taboada Carnero',
                    'email'      => 't.taboada@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Formación',
                    'position'   => 'Formación',
                    'phone'      => null,
                    'birthday'   => '1992-08-05',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Ana Vieira Mateos',
                    'email'      => 'a.vieira@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1976-11-04',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Aida Gonzalez Lopez',
                    'email'      => 'a.gonzalez@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Planificación',
                    'position'   => 'Planificación',
                    'phone'      => null,
                    'birthday'   => '1987-01-13',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Araceli Garcia Arza',
                    'email'      => 'a.garcia@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1982-08-06',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Paula Mateos Estanislao',
                    'email'      => 'p.mateos@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1990-03-05',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Jenny Lamariano Urizar',
                    'email'      => 'l.lamariano@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1986-03-05',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Rocio Muñoz Gonzalez',
                    'email'      => 'r.muñoz@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Formación',
                    'position'   => 'Formación',
                    'phone'      => null,
                    'birthday'   => '1988-01-07',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Xavier Bunuel Moreno',
                    'email'      => 'x.bunuel@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1990-01-30',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Elvira Elso Torralba',
                    'email'      => 'e.elso@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1971-04-14',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Paz Miguel Somalo',
                    'email'      => 'p.miguel@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Comunicación - marketing',
                    'position'   => 'Comunicación - marketing',
                    'phone'      => null,
                    'birthday'   => '1997-05-26',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Maria Calle Martinez',
                    'email'      => 'm.calle@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1980-11-15',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Aitor Itza Azkorra',
                    'email'      => 'a.itza@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1995-12-21',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Vicky Perez Calpe',
                    'email'      => 'a.perez@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => null,
                    'position'   => null,
                    'phone'      => null,
                    'birthday'   => '1988-08-03',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Alba Mata Lopez',
                    'email'      => 'mgbenergy@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '2000-07-13',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Markel Urkia Susin',
                    'email'      => 'm.markel@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1997-07-25',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Victor Hugo De la Torre Silva',
                    'email'      => 'v.delatorre@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1991-07-02',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Katherine Galué Pirela',
                    'email'      => 'k.galue@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1990-01-24',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Sonia Gonzalez',
                    'email'      => 's.gonzalez@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Formación',
                    'position'   => 'Formación',
                    'phone'      => null,
                    'birthday'   => '1974-09-18',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Fernando Freire Alvear',
                    'email'      => 'f.freire@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '1998-04-07',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Eneko Mata Zarza',
                    'email'      => 'e.mata@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => '2000-11-22',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Ruben Marin Cruz',
                    'email'      => 'r.marin@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '2023-07-30', // fecha del Excel, revisar si es correcta
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Irene Pastor Perdigones',
                    'email'      => 'I.pastor@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1994-11-09',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Manu Ceballos Montalvo',
                    'email'      => 'm.ceballos@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1991-10-24',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Belén Gómez Calderón',
                    'email'      => 'b.gomez@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Verificación (CAE)',
                    'position'   => 'Verificación (CAE)',
                    'phone'      => null,
                    'birthday'   => '1998-08-01',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Eneritz Souto Mimenza',
                    'email'      => 'diseno@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Marketing - diseño',
                    'position'   => 'Marketing - diseño',
                    'phone'      => null,
                    'birthday'   => '1996-04-27',
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'name'       => 'Noemi Chamorro',
                    'email'      => 'N.chamorro@margube.com',
                    'password'   => Hash::make('emp123'),
                    'role'       => 'employee',
                    'department' => 'Técnico',
                    'position'   => 'Técnico',
                    'phone'      => null,
                    'birthday'   => null, // no disponible en el Excel
                    'created_at' => now(), 'updated_at' => now(),
                ],
            ]);
        }

        // ─── ROOMS ───────────────────────────────────────────────────────────
        if (DB::table('company_rooms')->count() === 0) {
            DB::table('company_rooms')->insert([
                ['name' => 'Sala Reuniones A',  'capacity' => 8,  'description' => 'Sala principal con proyector', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Sala Reuniones B',  'capacity' => 12, 'description' => 'Sala grande con videoconferencia', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Sala Formación',    'capacity' => 25, 'description' => 'Aula con ordenadores', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Sala Directiva',    'capacity' => 6,  'description' => 'Uso exclusivo dirección', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // ─── CARS ────────────────────────────────────────────────────────────
        if (DB::table('company_cars')->count() === 0) {
            DB::table('company_cars')->insert([
                ['name' => 'Seat León',        'plate' => '1234-ABC', 'model' => '2022', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Volkswagen Passat','plate' => '5678-DEF', 'model' => '2021', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Toyota RAV4',      'plate' => '9012-GHI', 'model' => '2023', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // ─── NEWS ────────────────────────────────────────────────────────────
        if (DB::table('news')->count() === 0) {
            DB::table('news')->insert([
                [
                    'user_id'    => 1,
                    'type'       => 'evento',
                    'title'      => 'Reunión general de empresa Q1',
                    'body'       => 'Todos los departamentos se reunirán para revisar los objetivos del primer trimestre y planificar las estrategias para el resto del año. La asistencia es obligatoria.',
                    'event_date' => now()->addDays(5)->setTime(10, 0),
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'user_id'    => 1,
                    'type'       => 'noticia',
                    'title'      => 'Nuevo contrato con cliente premium',
                    'body'       => 'Nos complace anunciar que hemos firmado un contrato de colaboración estratégica con una importante empresa del sector. Este acuerdo supone un gran impulso para nuestro crecimiento.',
                    'event_date' => null,
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'user_id'    => 1,
                    'type'       => 'evento',
                    'title'      => 'Taller de herramientas digitales',
                    'body'       => 'Taller práctico sobre las nuevas herramientas de colaboración y productividad. Se recomienda la asistencia a todos los empleados. Habrá materiales y certificado de asistencia.',
                    'event_date' => now()->addDays(10)->setTime(9, 0),
                    'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'user_id'    => 1,
                    'type'       => 'noticia',
                    'title'      => 'Actualización de la política de teletrabajo',
                    'body'       => 'A partir del próximo mes, se amplían los días de teletrabajo permitidos a 3 días por semana. Consulta la guía completa en el apartado de RRHH o habla directamente con Ane Iturriaga.',
                    'event_date' => null,
                    'created_at' => now()->subDay(), 'updated_at' => now()->subDay(),
                ],
            ]);
        }

        // ─── ROOM RESERVATIONS ───────────────────────────────────────────────
        if (DB::table('room_reservations')->count() === 0) {
            DB::table('room_reservations')->insert([
                ['user_id' => 2, 'room' => 'Sala Reuniones A', 'date' => $today, 'hour' => '10:00', 'duration' => 2, 'reason' => 'Sprint review equipo IT',       'status' => 'confirmada', 'created_at' => now(), 'updated_at' => now()],
                ['user_id' => 3, 'room' => 'Sala Reuniones B', 'date' => $today, 'hour' => '15:00', 'duration' => 1, 'reason' => 'Brief de campaña',               'status' => 'confirmada', 'created_at' => now(), 'updated_at' => now()],
                ['user_id' => 4, 'room' => 'Sala Formación',   'date' => $in3,   'hour' => '09:00', 'duration' => 4, 'reason' => 'Onboarding nuevos comerciales',  'status' => 'pendiente',  'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // ─── CAR RESERVATIONS ────────────────────────────────────────────────
        if (DB::table('car_reservations')->count() === 0) {
            DB::table('car_reservations')->insert([
                ['user_id' => 3, 'car' => 'Seat León (1234-ABC)',         'date' => $tomorrow, 'hour' => '09:00', 'destination' => 'Barcelona', 'reason' => 'Visita a cliente', 'status' => 'confirmada', 'created_at' => now(), 'updated_at' => now()],
                ['user_id' => 4, 'car' => 'Volkswagen Passat (5678-DEF)', 'date' => $in3,      'hour' => '08:00', 'destination' => 'Valencia',  'reason' => 'Feria sectorial',  'status' => 'pendiente',  'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // ─── PURCHASE REQUESTS ───────────────────────────────────────────────
        if (DB::table('purchase_requests')->count() === 0) {
            DB::table('purchase_requests')->insert([
                ['user_id' => 2, 'item' => '💻 Ordenador portátil', 'quantity' => 1, 'reason' => 'Mi equipo actual tiene averías frecuentes y ralentiza el trabajo.', 'estimated_price' => 1200.00, 'status' => 'pendiente',  'admin_notes' => null,                                   'created_at' => now(),             'updated_at' => now()],
                ['user_id' => 3, 'item' => '🖥️ Monitor',            'quantity' => 2, 'reason' => 'Ampliación de espacio de trabajo con doble pantalla para diseño.', 'estimated_price' => 350.00,  'status' => 'aprobada',   'admin_notes' => 'Aprobado.',                            'created_at' => now()->subDays(2), 'updated_at' => now()->subDays(2)],
                ['user_id' => 5, 'item' => '🖨️ Impresora',          'quantity' => 1, 'reason' => 'La impresora del departamento de finanzas está averiada.',          'estimated_price' => 280.00,  'status' => 'rechazada',  'admin_notes' => 'Pendiente revisión técnica primero.',  'created_at' => now()->subDays(5), 'updated_at' => now()->subDays(5)],
            ]);
        }

        // ─── ABSENCES ────────────────────────────────────────────────────────
        if (DB::table('absences')->count() === 0) {
            DB::table('absences')->insert([
                ['user_id' => 6, 'type' => 'Vacaciones',    'start_date' => now()->addDays(14)->toDateString(), 'end_date' => now()->addDays(21)->toDateString(), 'reason' => 'Vacaciones de verano', 'status' => 'aprobada',  'created_at' => now(), 'updated_at' => now()],
                ['user_id' => 3, 'type' => 'Visita médica', 'start_date' => $tomorrow,                          'end_date' => $tomorrow,                          'reason' => 'Revisión anual',       'status' => 'pendiente', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}