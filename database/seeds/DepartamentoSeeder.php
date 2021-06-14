<?php

use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamento')->insert([
            ['dep_id' => 1, 'dep_nome' => 'Administrador'],
            ['dep_id' => 2, 'dep_nome' => 'Producao'],
            ['dep_id' => 3, 'dep_nome' => 'Materia Prima']
            ['dep_id' => 4, 'dep_nome' => 'Financeiro']
        ]);
    }
}
