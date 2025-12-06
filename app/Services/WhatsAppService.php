<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');
    }

    public function sendMessage($to, $message)
    {
        // 1. Cek Token
        if (empty($this->token)) {
            Log::warning("Fonnte Token kosong. Pesan tidak terkirim.");
            return false;
        }

        // 2. Format Nomor HP
        // Fonnte cukup fleksibel, tapi sebaiknya kita standarkan ke 08xx atau 62xx
        $target = $this->formatPhoneNumber($to);

        try {
            // 3. Kirim Request ke Fonnte API
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Default negara Indonesia
            ]);

            // 4. Cek Response
            // Fonnte mengembalikan JSON, kita cek apakah 'status' true/false
            $body = $response->json();

            if ($response->successful() && isset($body['status']) && $body['status'] == true) {
                Log::info("Fonnte Sukses kirim ke $target");
                return true;
            } else {
                // Log error detail dari Fonnte (misal: device disconnected)
                Log::error("Fonnte Gagal: " . json_encode($body));
                return false;
            }

        } catch (\Exception $e) {
            Log::error("Fonnte Error Koneksi: " . $e->getMessage());
            return false;
        }
    }

    // Helper: Membersihkan nomor agar hanya angka
    private function formatPhoneNumber($number)
    {
        // Hapus karakter selain angka (spasi, strip, plus)
        $number = preg_replace('/[^0-9]/', '', $number);
        
        // Fonnte bisa menerima 08... atau 62...
        // Kita biarkan apa adanya selama itu angka, Fonnte akan menanganinya
        return $number;
    }
}