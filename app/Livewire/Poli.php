<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Poli as PoliModel;
use Illuminate\Validation\Rule;

class Poli extends Component
{
    public $formAdd = false, $formEdit = false, $confirmingDelete = false;
    public $poli_id, $kuota, $nama_poli;
    public $selectPoliId;
    public $selectedPoliId;

    public function render()
    {
        $listPoli = PoliModel::all();
        return view('livewire.poli', compact('listPoli'));
    }

    public function add()
    {
        try {
    
            PoliModel::create([
                'kuota' => $this->kuota,
                'nama_poli' => $this->nama_poli,
            ]);
    
            $this->resetForm();
            $this->dispatch('success-message', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->dispatch('failed-message', 'Maaf Terjadi Kesalahan.');
        }
    }

    public function edit($id)
    {
        $this->formEdit = true;
        $poli = PoliModel::findOrFail($id);
        $this->poli_id = $poli->id;
        $this->kuota = $poli->kuota;
        $this->nama_poli = $poli->nama_poli;
    }

    public function update()
    {
        try {
            $poli = PoliModel::findOrFail($this->poli_id);
            $poli->update([
                'kuota' => $this->kuota,
                'nama_poli' => $this->nama_poli,
            ]);
    
            $this->resetForm();
            $this->dispatch('success-message', 'Data berhasil diubah.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->dispatch('failed-message', 'Maaf Terjadi Kesalahan.');
        }
    }

    public function confirmDelete($id)
    {
        $this->selectedPoliId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        try {
            $poli = PoliModel::findOrFail($this->selectedPoliId);
            $poli->delete();

            $this->confirmingDelete = false;
            $this->dispatch('success-message', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->dispatch('failed-message', 'Maaf Terjadi Kesalahan.');
        }
    }


    public function resetForm()
    {
        $this->formAdd = false;
        $this->formEdit = false;
        $this->poli_id = '';
        $this->kuota = '';
        $this->nama_poli = '';
        $this->resetErrorBag();
    }
}
