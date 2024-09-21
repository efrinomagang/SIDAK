<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Kelas;
use app\Models\RequestEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $firstName = '';

        switch ($user->role) {
            case 'kaprodi':
                $kaprodi = Kaprodi::where('user_id', $user->id)->first();
                $firstName = explode(' ', $kaprodi->name)[0];

                $totalDosen = Dosen::count();
                $totalMahasiswa = Mahasiswa::count();
                $totalKelas = Kelas::count();

                return view('dashboard.kaprodi', [
                    'firstName' => $firstName,
                    'totalDosen' => $totalDosen,
                    'totalMahasiswa' => $totalMahasiswa,
                    'totalKelas' => $totalKelas
                ]); break;

            case 'dosen':
                $dosen = Dosen::where('user_id', $user->id)->first();
                $firstName = explode(' ', $dosen->name)[0];

                $totalMahasiswa = Mahasiswa::count();
                $totalKelas = Kelas::count();

                return view('dashboard.dosen', [
                    'firstName' => $firstName,
                    'totalMahasiswa' => $totalMahasiswa,
                    'totalKelas' => $totalKelas
                ]);break;

                case 'mahasiswa':
                    // Get mahasiswa details and related requests
                    $mahasiswa = Mahasiswa::where('user_id', $user->id)
                                          ->with('kelas', 'requests') // Load 'kelas' and 'requests' relationships
                                          ->first();

                    // Get the dosen wali for the mahasiswa's class
                    $dosen = Dosen::where('kelas_id', $mahasiswa->kelas_id)->first();

                    // Get first name of mahasiswa
                    $firstName = explode(' ', $mahasiswa->name)[0];

                    // Count unread notifications (requests that haven't been viewed yet)
                    $unreadNotificationsCount = $mahasiswa->requests->where('is_read', false)->count();

                    // Count requests by status
                    $DisetujuiCount = $mahasiswa->requests->where('status', 'Disetujui')->count();
                    $DitolakCount = $mahasiswa->requests->where('status', 'Ditolak')->count();
                    $PendingCount = $mahasiswa->requests->where('status', 'Pending')->count();

                    // Count Pending requests
                    $PendingRequestsCount = $mahasiswa->requests->where('status', 'Pending')->count();

                    // Pass the necessary data to the view
                    return view('dashboard.mahasiswa', [
                        'firstName' => $firstName,
                        'mahasiswa' => $mahasiswa,
                        'dosen' => $dosen,
                        'unreadNotificationsCount' => $unreadNotificationsCount,
                        'DisetujuiCount' => $DisetujuiCount,
                        'DitolakCount' => $DitolakCount,
                        'PendingCount' => $PendingCount,
                        'PendingRequestsCount' => $PendingRequestsCount
                    ]);

                default:
                    abort(403, 'Unauthorized');
            }
        }
        public function detailMahasiswa(Request $request)
        {
            $search = $request->query('search');

            // Query to get all students with their classes
            $mahasiswas = Mahasiswa::with('kelas')
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('nim', 'like', '%' . $search . '%');
                })
                ->orderBy('kelas_id')  // Order by class id
                ->orderBy('nim')       // Order by nim within the same class
                ->get();

            return view('dashboard.detail-mahasiswa', compact('mahasiswas'));
        }
        public function detailKelas(Request $request)
        {
            // Retrieve the search query from the request
            $search = $request->query('search');

            // Query to get all classes with their assigned dosen (wali kelas)
            $kelas = Kelas::with('dosen')
                ->when($search, function ($query) use ($search) {
                    // Filter classes by name or other attributes
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->get();

            return view('dashboard.detail-kelas', compact('kelas'));
        }
        // DashboardController.php

public function detailProfile()
{
    // Fetch the authenticated user and the associated Kaprodi data
    $user = Auth::user();

    if ($user->role === 'kaprodi') {
        $kaprodi = Kaprodi::where('user_id', $user->id)->first();
    } else {
        abort(403, 'Unauthorized action.');
    }

    return view('dashboard.detail-profile', compact('user', 'kaprodi'));
}

public function updateProfile(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Validate the data
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:8|confirmed', // Password is nullable
    ]);

    $changes = false;

    // Update username if it has changed
    if ($user->username !== $validatedData['username']) {
        $user->username = $validatedData['username'];
        $changes = true;
    }

    // Update email if it has changed
    if ($user->email !== $validatedData['email']) {
        $user->email = $validatedData['email'];
        $changes = true;
    }

    // Check if password has been provided and is different
    if (!empty($validatedData['password'])) {
        $user->password = Hash::make($validatedData['password']);
        $changes = true;
    }

    // If there are no changes, show a message and redirect back
    if (!$changes) {
        return redirect()->route('dashboard.detail-profile')->with('error', 'Tidak ada perubahan');
    }

    // Save the updated user data
    $user->save();

    return redirect()->route('dashboard.detail-profile')->with('success', 'Sukses Update Profile.');
}

// DashboardController.php
public function detailDosen(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->query('search');

        // Query to get dosens with their associated user and class
        $dosens = Dosen::with('user', 'kelas')
            ->when($search, function ($query) use ($search) {
                // Filter dosens by name, NIP, or other attributes
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('nip', 'like', '%' . $search . '%');
            })
            ->get();

        return view('dashboard.detail-dosen', compact('dosens'));
    }

    }
