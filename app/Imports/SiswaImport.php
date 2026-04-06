<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {

        return new User([
            'name'     => $row['nama'],
            'username' => $row['nis'], // Untuk login
            'nis'      => $row['nis'], // Untuk data identitas (sesuai migration)
            'email'    => $row['email'],
            'password' => Hash::make($row['password'] ?? 'siswa123'),
            'role'     => 'siswa',
            'points'   => 0,
            'is_active' => true,
        ]);
    }

    public function rules(): array
    {
        return [
            'nis'   => 'required|unique:users,username', // Validasi agar NIS tidak dobel
            'nama'  => 'required|string',
            'email' => 'required|email|unique:users,email',
        ];
    }
}
