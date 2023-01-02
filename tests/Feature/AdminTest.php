<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{

    public function testAddBook()
    {
        $this->post('/admin/add/book',  [
            'judul-buku' => "Pemrograman java",
            'jml-halaman' => 212,
            'kategori' => 1,
            'nama-penulis-1' => 1,
            'nama-penerbit' => 1
        ])->assertRedirect('/admin')
        ->assertSessionHas('success');
    }


}
