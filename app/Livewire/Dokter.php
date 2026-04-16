<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Dokter as DokterModel;
use Illuminate\Validation\Rule;

class Dokter extends Component
{
    public $formAdd = false, $formEdit = false, $confirmingDelete = false;
    public $dokter_id, $kuota, $nama_dokter;
    public $selectDokterId;
    public $selectedDokterId;

    public function render()
    {
        $listDokter = DokterModel::all();
        return view('livewire.dokter', compact('listDokter'));
    }

    public function add()
    {
        try {
    
            DokterModel::create([
                'nama_dokter' => $this->nama_dokter,
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
        $dokter = DokterModel::findOrFail($id);
        $this->dokter_id = $dokter->id;
        $this->nama_dokter = $dokter->nama_dokter;
    }

    public function update()
    {
        try {
            $dokter = DokterModel::findOrFail($this->dokter_id);
            $dokter->update([
                'nama_dokter' => $this->nama_dokter,
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
        $this->selectedDokterId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        try {
            $dokter = DokterModel::findOrFail($this->selectedDokterId);
            $dokter->delete();

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
        $this->dokter_id = '';
        $this->nama_dokter = '';
        $this->resetErrorBag();
    }
}
