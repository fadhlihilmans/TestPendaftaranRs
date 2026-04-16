<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pasien as PasienModel;
use Illuminate\Validation\Rule;

class Pasien extends Component
{
    public $formAdd = false, $formEdit = false, $confirmingDelete = false;
    public $pasien_id, $nomor_rm, $nama_pasien, $alamat;
    public $selectPasienId;
    public $selectedPasienId;

    public function render()
    {
        $listPasien = PasienModel::all();
        return view('livewire.pasien', compact('listPasien'));
    }

    public function add()
    {
        $this->validate([
            'nomor_rm' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pasien', 'nomor_rm'), 
            ],
        ], [
            'nomor_rm.required' => 'Nomor RM wajib diisi.',
            'nomor_rm.unique' => 'Nomor RM sudah digunakan.',
        ]);
        try {
    
            PasienModel::create([
                'nomor_rm' => $this->nomor_rm,
                'nama_pasien' => $this->nama_pasien,
                'alamat' => $this->alamat,
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
        $pasien = PasienModel::findOrFail($id);
        $this->pasien_id = $pasien->id;
        $this->nomor_rm = $pasien->nomor_rm;
        $this->nama_pasien = $pasien->nama_pasien;
        $this->alamat = $pasien->alamat;
    }

    public function update()
    {
        $this->validate([
            'nomor_rm' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pasien', 'nomor_rm')->ignore($this->pasien_id),
            ],
        ], [
            'nomor_rm.required' => 'Nomor RM wajib diisi.',
            'nomor_rm.unique' => 'Nomor RM sudah digunakan.',
        ]);
        try {
            $pasien = PasienModel::findOrFail($this->pasien_id);
            $pasien->update([
                'nomor_rm' => $this->nomor_rm,
                'nama_pasien' => $this->nama_pasien,
                'alamat' => $this->alamat,
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
        $this->selectedPasienId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        try {
            $pasien = PasienModel::findOrFail($this->selectedPasienId);
            $pasien->delete();

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
        $this->pasien_id = '';
        $this->nomor_rm = '';
        $this->nama_pasien = '';
        $this->alamat = '';
        $this->resetErrorBag();
    }
}
