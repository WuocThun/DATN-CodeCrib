<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Tải bộ package
use GuzzleHttp\Client;

class VietMapProviders extends ServiceProvider
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getProvinceData($province_id)
    {
        try {
            // Gửi yêu cầu GET đến API
            $response
                  = $this->client->get('https://vapi.vnappmob.com/api/v2/province/');
            $data = json_decode($response->getBody(), true);

            // Kiểm tra dữ liệu
            if (isset($data['results']) && is_array($data['results'])) {
                // Duyệt qua danh sách các tỉnh
                foreach ($data['results'] as $province) {
                    // Kiểm tra province_id
                    if ($province['province_id'] == $province_id) {
                        // Trả về thông tin tỉnh tìm thấy
                        return response()->json([
                            'province_id'   => $province['province_id'],
                            'province_name' => $province['province_name'],
                        ]);
                    }
                }
            }

            // Nếu không tìm thấy
            return response()->json(['message' => 'Province not found'], 404);
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
    }

    public function getDistrictData($districtId)
    {
        // Gọi API để lấy danh sách quận
        $response = $this->client->get('https://api.vnappmob.com/api/v2/province/district/' . $districtId);

        // Giải mã nội dung JSON
        $districtData = json_decode($response->getBody()->getContents(), true);

        // Kiểm tra và lấy tên quận
        if (isset($districtData['results']) && !empty($districtData['results'])) {
            // Giả sử dữ liệu trả về là mảng với các quận
            $districtName = $districtData['results'][0]['district_name'] ?? null;

            return $districtName;
        } else {
            return 'District not found or an error occurred.';
        }
    }

    public function getProvinces()
    {
        $response
            = $this->client->get('https://api.vnappmob.com/api/v2/province/');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getDistricts($provinceId)
    {
        $response
            = $this->client->get("https://api.vnappmob.com/api/v2/province/district/$provinceId");

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWards($districtId)
    {
        $response
            = $this->client->get("https://api.vnappmob.com/api/v2/province/ward/$districtId");

        return json_decode($response->getBody()->getContents(), true);
    }

}
