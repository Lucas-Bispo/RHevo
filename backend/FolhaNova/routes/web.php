<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoEsocialController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\LotacaoController;
use App\Http\Controllers\OrgaoPublicoController;
use App\Http\Controllers\RootRedirectController;
use App\Http\Controllers\RubricaController;
use App\Http\Controllers\ServidorController;
use Illuminate\Support\Facades\Route;

Route::get('/', RootRedirectController::class);

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('orgao-publico', [OrgaoPublicoController::class, 'show'])
    ->middleware(['auth'])
    ->name('orgao-publico.show');

Route::get('orgao-publico/editar', [OrgaoPublicoController::class, 'edit'])
    ->middleware(['auth'])
    ->name('orgao-publico.edit');

Route::put('orgao-publico', [OrgaoPublicoController::class, 'update'])
    ->middleware(['auth'])
    ->name('orgao-publico.update');

Route::get('eventos-esocial', [EventoEsocialController::class, 'index'])
    ->middleware(['auth'])
    ->name('eventos-esocial.index');

Route::get('eventos-esocial/{eventoEsocial}', [EventoEsocialController::class, 'show'])
    ->middleware(['auth'])
    ->name('eventos-esocial.show');

Route::post('eventos-esocial/{eventoEsocial}/reprocessar', [EventoEsocialController::class, 'reprocessar'])
    ->middleware(['auth'])
    ->name('eventos-esocial.reprocessar');

Route::get('rubricas', [RubricaController::class, 'index'])
    ->middleware(['auth'])
    ->name('rubricas.index');

Route::get('rubricas/nova', [RubricaController::class, 'create'])
    ->middleware(['auth'])
    ->name('rubricas.create');

Route::post('rubricas', [RubricaController::class, 'store'])
    ->middleware(['auth'])
    ->name('rubricas.store');

Route::get('rubricas/{rubrica}/editar', [RubricaController::class, 'edit'])
    ->middleware(['auth'])
    ->name('rubricas.edit');

Route::put('rubricas/{rubrica}', [RubricaController::class, 'update'])
    ->middleware(['auth'])
    ->name('rubricas.update');

Route::get('servidores', [ServidorController::class, 'index'])
    ->middleware(['auth'])
    ->name('servidores.index');

Route::get('servidores/novo', [ServidorController::class, 'create'])
    ->middleware(['auth'])
    ->name('servidores.create');

Route::post('servidores', [ServidorController::class, 'store'])
    ->middleware(['auth'])
    ->name('servidores.store');

Route::get('servidores/{servidor}', [ServidorController::class, 'show'])
    ->middleware(['auth'])
    ->name('servidores.show');

Route::get('servidores/{servidor}/editar', [ServidorController::class, 'edit'])
    ->middleware(['auth'])
    ->name('servidores.edit');

Route::put('servidores/{servidor}', [ServidorController::class, 'update'])
    ->middleware(['auth'])
    ->name('servidores.update');

Route::get('lotacoes', [LotacaoController::class, 'index'])
    ->middleware(['auth'])
    ->name('lotacoes.index');

Route::get('lotacoes/nova', [LotacaoController::class, 'create'])
    ->middleware(['auth'])
    ->name('lotacoes.create');

Route::post('lotacoes', [LotacaoController::class, 'store'])
    ->middleware(['auth'])
    ->name('lotacoes.store');

Route::get('lotacoes/{lotacao}/editar', [LotacaoController::class, 'edit'])
    ->middleware(['auth'])
    ->name('lotacoes.edit');

Route::put('lotacoes/{lotacao}', [LotacaoController::class, 'update'])
    ->middleware(['auth'])
    ->name('lotacoes.update');

Route::get('cargos', [CargoController::class, 'index'])
    ->middleware(['auth'])
    ->name('cargos.index');

Route::get('cargos/novo', [CargoController::class, 'create'])
    ->middleware(['auth'])
    ->name('cargos.create');

Route::post('cargos', [CargoController::class, 'store'])
    ->middleware(['auth'])
    ->name('cargos.store');

Route::get('cargos/{cargo}/editar', [CargoController::class, 'edit'])
    ->middleware(['auth'])
    ->name('cargos.edit');

Route::put('cargos/{cargo}', [CargoController::class, 'update'])
    ->middleware(['auth'])
    ->name('cargos.update');

Route::get('funcoes', [FuncaoController::class, 'index'])
    ->middleware(['auth'])
    ->name('funcoes.index');

Route::get('funcoes/nova', [FuncaoController::class, 'create'])
    ->middleware(['auth'])
    ->name('funcoes.create');

Route::post('funcoes', [FuncaoController::class, 'store'])
    ->middleware(['auth'])
    ->name('funcoes.store');

Route::get('funcoes/{funcao}/editar', [FuncaoController::class, 'edit'])
    ->middleware(['auth'])
    ->name('funcoes.edit');

Route::put('funcoes/{funcao}', [FuncaoController::class, 'update'])
    ->middleware(['auth'])
    ->name('funcoes.update');

require __DIR__.'/auth.php';
