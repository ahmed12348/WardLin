<?php

namespace App\Repositories;

use App\Models\Company;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CompanyRepository.
 */
class CompanyRepository
{
    public function getAllCompanies()
    {
        return Company::all();
    }

    public function getCompanyById($id)
    {
        return Company::find($id);
    }

    public function create(array $data)
    {
        return Company::create($data);
    }

    public function find($id)
    {
        return Company::find($id);
    }

    public function update($id, array $data)
    {
        $company = Company::find($id);
        if ($company) {
            $company->update($data);
            return $company;
        }
        return null;
    }

    public function delete($id)
    {
        $company = Company::find($id);

        if ($company) {
            $isDeleted = $company->delete(); // Change the method to use delete() and capture the result
            return $isDeleted; // Return the deletion result
        }
        return false;
    }
}
