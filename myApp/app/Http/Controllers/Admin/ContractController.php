<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Motel;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

class ContractController extends Controller
{
    public function create()
    {
        $motels = Motel::where('user_id', Auth::id())->get();
        return view('admin_core.content.contracts.create', compact('motels'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'motel_id' => 'required|exists:motel,id',
            'tenant_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'contract_image' => 'nullable|array',
            'contract_image.*' => 'image',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $images = [];
        if ($request->hasFile('contract_image')) {
            foreach ($request->file('contract_image') as $img) {
                $path = 'uploads/contracts/';
                $new_image = $img->getClientOriginalName() . rand(0, 99) . '.' . $img->getClientOriginalExtension();
                $img->move($path, $new_image);
                $images[] = $new_image;
            }
            $data['contract_image'] = json_encode($images);
        }
        $contract = Contract::create($data);

        // Tạo hợp đồng

        // Tạo file Word từ template
        $templateProcessor = new TemplateProcessor('templates/contract_template.docx');
        $templateProcessor->setValue('tenant_name', $contract->tenant_name);
        $templateProcessor->setValue('motel_id', $contract->motel_id);
        $templateProcessor->setValue('owner_name', $contract->owner_name);
        $templateProcessor->setValue('start_date', $contract->start_date);
        $templateProcessor->setValue('end_date', $contract->end_date);
        $templateProcessor->setValue('motel_name', $contract->motel->name ?? 'N/A');

        // Lưu file Word vào thư mục cố định
        $wordFileName = 'hopdong_' . $contract->id . '.docx';
        $wordFilePath = public_path('uploads/contracts/' . $wordFileName);
        $templateProcessor->saveAs($wordFilePath);

        // Lưu đường dẫn file Word vào cơ sở dữ liệu (nếu cần)
        $contract->update(['contract_file' => 'uploads/contracts/' . $wordFileName]);

        return redirect()->route('admin.motel.index')->with('success', 'Hợp đồng đã được tạo thành công.');
    }
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'motel_id' => 'required|exists:motel,id',
            'tenant_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'contract_image' => 'nullable|array',
            'contract_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Xử lý hình ảnh hợp đồng
        $images = json_decode($contract->contract_image, true) ?? [];
        if ($request->hasFile('contract_image')) {
            foreach ($request->file('contract_image') as $img) {
                $path = 'uploads/contracts/';
                $new_image = $img->getClientOriginalName() . rand(0, 99) . '.' . $img->getClientOriginalExtension();
                $img->move($path, $new_image);
                $images[] = $new_image;
            }
            $data['contract_image'] = json_encode($images);
        }

        // Cập nhật hợp đồng
        $contract->update($data);
//dd($data);
        // Cập nhật file Word
        $templateProcessor = new TemplateProcessor('templates/contract_template.docx');
        $templateProcessor->setValue('tenant_name', $contract->tenant_name);
        $templateProcessor->setValue('motel_id', $contract->motel_id);
        $templateProcessor->setValue('owner_name', $contract->owner_name);
        $templateProcessor->setValue('start_date', $contract->start_date);
        $templateProcessor->setValue('end_date', $contract->end_date);
        $templateProcessor->setValue('motel_name', $contract->motel->name ?? 'N/A');

        $wordFileName = 'hopdong_' . $contract->id . '.docx';
        $wordFilePath = public_path('uploads/contracts/' . $wordFileName);
        $templateProcessor->saveAs($wordFilePath);

        $contract->update(['contract_file' => 'uploads/contracts/' . $wordFileName]);

        return redirect()->route('admin.motel.index')->with('success', 'Hợp đồng đã được cập nhật thành công.');
    }

    public function deleteContract($id)
    {
        // Kiểm tra quyền sở hữu hợp đồng
//        if ($contract->user_id != Auth::id()) {
//            return redirect()->route('admin.motel.index')->with('error', 'Bạn không có quyền xóa hợp đồng này.');
//        }
        $contract = Contract::find($id);
        // Xóa hợp đồng
        $contract->delete();

        return redirect()->route('admin.motel.index')->with('success', 'Hợp đồng đã được xóa thành công.');
    }


    public function index()
    {
        $contracts = Contract::where('user_id', Auth::id())->paginate(10);
        return view('admin_core.content.contracts.create', compact('contracts'));
    }
}
