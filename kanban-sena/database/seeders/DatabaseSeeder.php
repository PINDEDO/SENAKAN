<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Datos demo (solo desarrollo).
 *
 * Un usuario por rol. Contraseñas en texto plano (solo referencia local):
 * - admin:        admin@sena.demo        → SenaAdmin2026!
 * - funcionario:  funcionario@sena.demo  → SenaFunc2026!
 * - coordinador:  coordinador@sena.demo  → SenaCoord2026!
 * - instructor:   instructor@sena.demo   → SenaInst2026!
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Vacía tablas dependientes y usuarios para volver a sembrar sin conflictos de claves.
     */
    protected function resetApplicationData(): void
    {
        DB::table('sessions')->delete();
        DB::table('password_reset_tokens')->delete();
        DB::table('activity_logs')->delete();
        DB::table('messages')->delete();
        DB::table('tasks')->delete();
        DB::table('projects')->delete();
        DB::table('users')->delete();
    }

    /**
     * @return list<array{name: string, email: string, password_plain: string, role: string}>
     */
    protected function roleUsersDefinition(): array
    {
        return [
            [
                'name' => 'Administrador SENA',
                'email' => 'admin@sena.demo',
                'password_plain' => 'SenaAdmin2026!',
                'role' => 'admin',
            ],
            [
                'name' => 'Funcionario SENA',
                'email' => 'funcionario@sena.demo',
                'password_plain' => 'SenaFunc2026!',
                'role' => 'funcionario',
            ],
            [
                'name' => 'Coordinador SENA',
                'email' => 'coordinador@sena.demo',
                'password_plain' => 'SenaCoord2026!',
                'role' => 'coordinador',
            ],
            [
                'name' => 'Instructor SENA',
                'email' => 'instructor@sena.demo',
                'password_plain' => 'SenaInst2026!',
                'role' => 'instructor',
            ],
        ];
    }

    /**
     * IDs fijos: 1 admin, 2 funcionario, 3 coordinador, 4 instructor.
     *
     * @return list<int>
     */
    protected function seedUsers(): array
    {
        $now = now()->toDateTimeString();
        $rows = [];
        $id = 1;

        foreach ($this->roleUsersDefinition() as $def) {
            $rows[] = [
                'id' => $id,
                'name' => $def['name'],
                'email' => $def['email'],
                'password' => Hash::make($def['password_plain']),
                'role' => $def['role'],
                'center_id' => null,
                'avatar' => null,
                'active' => 1,
                'last_login' => null,
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $id++;
        }

        DB::table('users')->insert($rows);

        return [1, 2, 3, 4];
    }

    /**
     * Seed the application's database with data from the SQL dump.
     */
    public function run(): void
    {
        $this->resetApplicationData();

        [$idAdmin, $idFuncionario, , $idInstructor] = $this->seedUsers();

        $ts = '2026-03-07 05:15:07';

        // Projects (propietario: administrador)
        DB::table('projects')->insert([
            [
                'id' => 1,
                'name' => 'PROYECTOS FORMATIVOS',
                'code' => '2929061',
                'description' => 'Levantar requisitos',
                'status' => 'active',
                'color' => '#39A900',
                'user_id' => $idAdmin,
                'created_at' => $ts,
                'updated_at' => $ts,
            ],
            [
                'id' => 2,
                'name' => 'INDUCCION FICHA NUEVA',
                'code' => '2828061',
                'description' => 'Programar induccion ficha',
                'status' => 'active',
                'color' => '#39A900',
                'user_id' => $idAdmin,
                'created_at' => '2026-03-07 06:52:55',
                'updated_at' => '2026-03-07 06:52:55',
            ],
        ]);

        // Tasks: asignaciones alineadas a los nuevos IDs (instructor=4, funcionario=2)
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'title' => 'Crear modelo uml',
                'description' => 'Aplica estandares de desarrollo',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => '2026-03-17',
                'order' => 0,
                'project_id' => 1,
                'assigned_to' => $idAdmin,
                'created_by' => $idAdmin,
                'created_at' => '2026-03-07 05:15:35',
                'updated_at' => '2026-03-07 06:48:48',
            ],
            [
                'id' => 2,
                'title' => 'CONOCER FICHA NUEVA',
                'description' => 'Acercamiento a la ficha nueva',
                'status' => 'done',
                'priority' => 'low',
                'due_date' => '2026-03-10',
                'order' => 0,
                'project_id' => 2,
                'assigned_to' => $idInstructor,
                'created_by' => $idAdmin,
                'created_at' => '2026-03-07 06:53:23',
                'updated_at' => '2026-03-07 06:56:45',
            ],
            [
                'id' => 3,
                'title' => 'RECORRIDO FICHA NUEVA',
                'description' => 'Llevar a cabo la ruta por a regional a la ficha nueva',
                'status' => 'progress',
                'priority' => 'medium',
                'due_date' => '2026-03-13',
                'order' => 0,
                'project_id' => 2,
                'assigned_to' => $idInstructor,
                'created_by' => $idAdmin,
                'created_at' => '2026-03-07 06:54:02',
                'updated_at' => '2026-03-07 06:56:48',
            ],
            [
                'id' => 4,
                'title' => 'CONOCER SERIVICIOS BASICOS',
                'description' => 'Presentar al equipo de bienestar a los aprendices',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => '2026-03-09',
                'order' => 1,
                'project_id' => 2,
                'assigned_to' => $idFuncionario,
                'created_by' => $idAdmin,
                'created_at' => '2026-03-07 06:55:05',
                'updated_at' => '2026-03-07 06:56:47',
            ],
        ]);

        DB::table('activity_logs')->insert([
            ['id' => 1,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'created',       'description' => 'Creó la tarea: Crear modelo uml',                                                              'created_at' => '2026-03-07 05:15:35', 'updated_at' => '2026-03-07 05:15:35'],
            ['id' => 2,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'pending' a 'progress' para la tarea: Crear modelo uml",                   'created_at' => '2026-03-07 05:15:38', 'updated_at' => '2026-03-07 05:15:38'],
            ['id' => 3,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'progress' a 'done' para la tarea: Crear modelo uml",                      'created_at' => '2026-03-07 05:15:39', 'updated_at' => '2026-03-07 05:15:39'],
            ['id' => 4,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'done' a 'progress' para la tarea: Crear modelo uml",                      'created_at' => '2026-03-07 05:15:40', 'updated_at' => '2026-03-07 05:15:40'],
            ['id' => 5,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'progress' a 'pending' para la tarea: Crear modelo uml",                   'created_at' => '2026-03-07 05:15:41', 'updated_at' => '2026-03-07 05:15:41'],
            ['id' => 6,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'updated',       'description' => 'Actualizó la información de la tarea: Crear modelo uml',                                       'created_at' => '2026-03-07 05:15:47', 'updated_at' => '2026-03-07 05:15:47'],
            ['id' => 7,  'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'pending' a 'progress' para la tarea: Crear modelo uml",                   'created_at' => '2026-03-07 05:16:49', 'updated_at' => '2026-03-07 05:16:49'],
            ['id' => 10, 'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'progress' a 'done' para la tarea: Crear modelo uml",                      'created_at' => '2026-03-07 06:17:22', 'updated_at' => '2026-03-07 06:17:22'],
            ['id' => 11, 'user_id' => $idAdmin, 'task_id' => 1, 'action' => 'status_change', 'description' => "Cambió el estado de 'done' a 'pending' para la tarea: Crear modelo uml",                       'created_at' => '2026-03-07 06:48:48', 'updated_at' => '2026-03-07 06:48:48'],
            ['id' => 12, 'user_id' => $idAdmin, 'task_id' => 2, 'action' => 'created',       'description' => 'Creó la tarea: CONOCER FICHA NUEVA',                                                           'created_at' => '2026-03-07 06:53:23', 'updated_at' => '2026-03-07 06:53:23'],
            ['id' => 13, 'user_id' => $idAdmin, 'task_id' => 3, 'action' => 'created',       'description' => 'Creó la tarea: RECORRIDO FICHA NUEVA',                                                         'created_at' => '2026-03-07 06:54:02', 'updated_at' => '2026-03-07 06:54:02'],
            ['id' => 14, 'user_id' => $idAdmin, 'task_id' => 4, 'action' => 'created',       'description' => 'Creó la tarea: CONOCER SERIVICIOS BASICOS',                                                    'created_at' => '2026-03-07 06:55:05', 'updated_at' => '2026-03-07 06:55:05'],
            ['id' => 15, 'user_id' => $idAdmin, 'task_id' => 4, 'action' => 'status_change', 'description' => "Cambió el estado de 'pending' a 'progress' para la tarea: CONOCER SERIVICIOS BASICOS",         'created_at' => '2026-03-07 06:55:07', 'updated_at' => '2026-03-07 06:55:07'],
            ['id' => 16, 'user_id' => $idAdmin, 'task_id' => 4, 'action' => 'status_change', 'description' => "Cambió el estado de 'progress' a 'pending' para la tarea: CONOCER SERIVICIOS BASICOS",         'created_at' => '2026-03-07 06:55:08', 'updated_at' => '2026-03-07 06:55:08'],
            ['id' => 17, 'user_id' => $idAdmin, 'task_id' => 2, 'action' => 'status_change', 'description' => "Cambió el estado de 'pending' a 'progress' para la tarea: CONOCER FICHA NUEVA",                'created_at' => '2026-03-07 06:55:10', 'updated_at' => '2026-03-07 06:55:10'],
            ['id' => 18, 'user_id' => $idAdmin, 'task_id' => 2, 'action' => 'status_change', 'description' => "Cambió el estado de 'progress' a 'done' para la tarea: CONOCER FICHA NUEVA",                   'created_at' => '2026-03-07 06:56:45', 'updated_at' => '2026-03-07 06:56:45'],
            ['id' => 19, 'user_id' => $idAdmin, 'task_id' => 3, 'action' => 'status_change', 'description' => "Cambió el estado de 'pending' a 'progress' para la tarea: RECORRIDO FICHA NUEVA",              'created_at' => '2026-03-07 06:56:48', 'updated_at' => '2026-03-07 06:56:48'],
        ]);
    }
}
