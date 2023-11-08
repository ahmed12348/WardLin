<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $companies = $this->companyRepository->all();
        return response()->json($companies);
    }

    public function show($id)
    {
        $company = $this->companyRepository->find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url'
            // Add validation rules for other fields
        ]);

        $company = $this->companyRepository->create($data);

        return response()->json($company, 201);
    }

    public function update(Request $request, $id)
    {
        $company = $this->companyRepository->find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url'
            // Add validation rules for other fields
        ]);

        $updatedCompany = $this->companyRepository->update($id, $data);

        return response()->json($updatedCompany);
    }

    public function destroy($id)
    {
        $company = $this->companyRepository->find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $this->companyRepository->delete($id);

        return response()->json(['message' => 'Company deleted']);
    }
}
