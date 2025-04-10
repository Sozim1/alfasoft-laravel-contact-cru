<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Rotas da aplicação de contatos.
| Por padrão, usamos Route::resource() para registrar as rotas REST.
| Porém, no ambiente de homologação da Alfasoft, detectei um comportamento
| inesperado ao acessar rotas como /contacts/create e /contacts/{id}/edit,
| que resultam em erro 404, mesmo com todas as configurações corretas.
|
| Como solução de contorno, optei por registrar manualmente essas rotas
| protegidas por autenticação, mantendo a consistência da aplicação.
*/

Auth::routes();

    Route::resource('contacts', ContactController::class)->only(['index', 'show']);

    Route::middleware('auth')->group(function () {
        Route::get('contacts-export-csv', [ContactController::class, 'export'])->name('contacts.export');
        Route::get('/criar-contato', [ContactController::class, 'create'])->name('contacts.create');

        Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');

        Route::get('contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
        Route::put('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');

        Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    });

    Route::get('/', function () {
        return redirect()->route('contacts.index');
    });

    Route::post('/change-language', function () {
        session()->put('locale', request('language'));
        return redirect()->back();
    })->name('change.language');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
