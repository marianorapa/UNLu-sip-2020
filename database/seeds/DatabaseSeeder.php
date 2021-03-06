<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(ProvinciaTableSeeder::class);
        $this->call(LocalidadTableSeeder::class);
        $this->call(DomicilioTableSeeder::class);
        $this->call(PersonaTipoTableSeeder::class);
        $this->call(PersonasTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermisoTableSeeder::class);
        $this->call(RolePermisosSeeder::class);
        //chof                                                  ----
        $this->call(EmpresaTableSeeder::class);
        $this->call(ClienteTableSeeder::class);
        $this->call(ProveedorTableSeeder::class);
        $this->call(TransportistaTableSeeder::class);
        //pesaje
        $this->call(EstadoTicketTableSeeder::class);
        //ticket, estado_ticket_ticket
        $this->call(InsumoTableSeeder::class);
        $this->call(InsumoTrazableSeeder::class);
        $this->call(InsumoEspecificoTableSeeder::class);
        //loteInsumoEsp, ticketEntrada, teTra, teNoTra
        $this->call(AlimentoTipoTableSeeder::class);
        $this->call(AlimentoTableSeeder::class);
        $this->call(AlimentoFormulaTableSeeder::class);
        $this->call(FormulaComposicionTableSeeder::class);
        $this->call(EstadoOrdProTableSeeder::class);
        //granja                                                ----
        $this->call(NivelPrioridadTableSeeder::class);
        $this->call(CapacidadProductivaTableSeeder::class);
        $this->call(PrecioFasonTableSeeder::class);
        //ordpro, opDetNoTra, opDetTra, tktSalida, remito
        $this->call(CreditoClienteTableSeeder::class);
        //prestamoCli, prestamoDev
        //tipoMovimiento                                        ----
        $this->call(TipoMovimientoSeeder::class);
        //movimientos: movIns, movProd, etc.
    }
}
