<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pendaftaran as PendaftaranModel;
use App\Models\Pasien as PasienModel;
use App\Models\Poli as PoliModel;
use App\Models\Dokter as DokterModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Pendaftaran extends Component
{
    public $formAdd = false, $formEdit = false, $confirmingDelete = false, $kuotaAlert = false;
    public $search = '';
    public $pendaftaran_id, $tanggal_daftar, $pasien_id, $poli_id, $dokter_id;
    public $selectedPendaftaranId, $listPasien, $listPoli, $listDokter;
    public $kuota, $getKuotaPoli;
    
    public function render()
    {
        $this->listPasien = PasienModel::get();
        $this->listPoli = PoliModel::get();
        $this->listDokter = DokterModel::get();

        $listPendaftaran = PendaftaranModel::with('pasien', 'poli', 'dokter')->get();
        return view('livewire.pendaftaran', compact('listPendaftaran'));
    }

    public function add()
    {
        // $this->validate([
        //     'id_program_keahlian' => 'required|exists:program_keahlian,id',
        //     'pendaftaran' => [
        //         'required',
        //         'string',
        //         'max:255',
        //         Rule::unique('pendaftaran', 'pendaftaran')->whereNull('deleted_at'), 
        //     ],
        // ], [
        //     'id_program_keahlian.required' => 'Program keahlian wajib dipilih.',
        //     'pendaftaran.required' => 'Nama wajib diisi.',
        //     'pendaftaran.unique' => 'Nama sudah digunakan.',
        // ]);
        try {
            DB::beginTransaction();

            $this->getKuotaPoli = PoliModel::where('id', $this->poli_id)->get();
            foreach ($this->getKuotaPoli as $i){
                if($i->kuota != 0){
                    $kuotaAKhir = $i->kuota - 1;
                }else{
                    $this->dispatch('failed-message', 'Kota Poli 0, besok lagi :).');
                }
            }

            PendaftaranModel::create([
                'pasien_id' => $this->pasien_id,
                'poli_id' => $this->poli_id,
                'dokter_id' => $this->dokter_id,
                'tanggal_daftar' => $this->tanggal_daftar,
            ]);

            $poliUpdate = PoliModel::where('id', $this->poli_id);
            $poliUpdate->update([
                'kuota' => $kuotaAKhir,
            ]);
    
            DB::commit();

            $this->resetForm(); 
            $this->dispatch('success-message', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            $this->dispatch('failed-message', 'Maaf Terjadi Kesalahan.');
        }
    }

    public function edit($id)
    {
        $this->formEdit = true;
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $this->pendaftaran_id = $pendaftaran->id;
        $this->pasien_id = $pendaftaran->pasien_id;
        $this->poli_id = $pendaftaran->poli_id;
        $this->dokter_id = $pendaftaran->dokter_id;
        $this->tanggal_daftar = $pendaftaran->tanggal_daftar;
        
        // $getKuotaPoli = PoliModel::where('id', $pendaftaran->poli_id)->get();
        // foreach ($getKuotaPoli as $i){
        //     dd($i->kuota);
        // }
    }

    public function update()
    {
        // $this->validate([
        //     'id_program_keahlian' => 'required|exists:program_keahlian,id',
        //     'pendaftaran' => [
        //         'required',
        //         'string',
        //         'max:255',
        //         Rule::unique('pendaftaran', 'pendaftaran')->ignore($this->pendaftaran_id)->whereNull('deleted_at'),
        //     ],
        // ], [
        //     'id_program_keahlian.required' => 'Program keahlian wajib dipilih.',
        //     'pendaftaran.required' => 'Nama wajib diisi.',
        //     'pendaftaran.unique' => 'Nama sudah digunakan.',
        // ]);
        try {
    
            DB::beginTransaction();

            $pendaftaran = PendaftaranModel::findOrFail($this->pendaftaran_id);
            $pendaftaran->update([
                'pasien_id' => $this->pasien_id,
                'poli_id' => $this->poli_id,
                'dokter_id' => $this->dokter_id,
                'tanggal_daftar' => $this->tanggal_daftar,
            ]);

            DB::commit();
    
            $this->resetForm();
            $this->dispatch('success-message', 'Data berhasil diubah.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            $this->dispatch('failed-message', 'Maaf Terjadi Kesalahan.');
        }
    }

    public function confirmDelete($id)
    {
        $this->selectedPendaftaranId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        try {
            
            DB::beginTransaction();

            $pendaftaran = PendaftaranModel::findOrFail($this->selectedPendaftaranId);
            $pendaftaran->delete();

            DB::commit();

            $this->confirmingDelete = false;
            $this->dispatch('success-message', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            $this->dispatch('failed-message', 'Maaf Terjadi Kesalahan.');
        }
    }


    public function resetForm()
    {
        $this->formAdd = false;
        $this->formEdit = false;
        $this->pendaftaran_id = '';
        $this->pasien_id = '';
        $this->poli_id = '';
        $this->dokter_id = '';
        $this->tanggal_daftar = '';
        $this->resetErrorBag();
    }
}
