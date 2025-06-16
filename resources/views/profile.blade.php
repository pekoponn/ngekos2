@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <!-- Cover Photo -->
                <div class="cover-photo" style="height: 200px; background: var(--primary-gradient);"></div>
                
                <!-- Profile Section -->
                <div class="px-4 pb-4 position-relative">
                    <!-- Profile Picture -->
                    <div class="profile-picture-container">
                        <div class="profile-picture">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     class="rounded-circle" width="120" height="120" 
                                     alt="Profile Avatar">
                            @else
                                <div class="avatar-placeholder rounded-circle">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <button class="btn btn-sm btn-primary edit-avatar-btn" data-bs-toggle="modal" data-bs-target="#avatarModal">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    
                    <!-- User Info -->
                    <div class="mt-5 pt-4">
                        <h2 class="mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-muted mb-3">
                            <i class="fas fa-envelope me-2"></i> {{ Auth::user()->email }}
                        </p>
                        
                        <div class="d-flex gap-3 mb-4">
                            <div>
                                <i class="fas fa-phone me-2"></i> 
                                {{ Auth::user()->phone ?? 'Belum diatur' }}
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt me-2"></i> 
                                {{ Auth::user()->address ?? 'Belum diatur' }}
                            </div>
                        </div>
                        
                        <p class="bio mb-4">
                            {{ Auth::user()->bio ?? 'Tidak ada bio' }}
                        </p>
                    </div>
                    
                    <!-- Edit Profile Button -->
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-2"></i> Edit Profil
                        </button>
                    </div>
                </div>
                
                <!-- Tabs -->
                <ul class="nav nav-tabs px-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="settings-tab" data-bs-toggle="tab" 
                                data-bs-target="#settings" type="button" role="tab">
                            <i class="fas fa-cog me-2"></i> Pengaturan
                        </button>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content p-4" id="profileTabsContent">
                    <div class="tab-pane fade show active" id="settings" role="tabpanel">
                        <h5 class="mb-4">Pengaturan Akun</h5>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ganti Password</label>
                                <input type="password" class="form-control" placeholder="Password Baru">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" placeholder="Konfirmasi Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3">{{ Auth::user()->address ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3">{{ Auth::user()->bio ?? '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ganti Avatar -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-4">
                        @if(Auth::user()->avatar)
                            <img id="avatarPreview" src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 class="rounded-circle" width="150" height="150" 
                                 alt="Profile Avatar">
                        @else
                            <div id="avatarPreview" class="avatar-placeholder rounded-circle mx-auto">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Pilih Foto Profil</label>
                        <input class="form-control" type="file" id="avatar" name="avatar" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .cover-photo {
        background-size: cover;
        background-position: center;
    }
    .profile-picture-container {
        position: relative;
        margin-top: -60px;
    }
    .profile-picture {
        width: 120px;
        height: 120px;
        border: 5px solid white;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: var(--shadow);
    }
    .edit-avatar-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-placeholder {
        width: 150px;
        height: 150px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #999;
    }
    .bio {
        white-space: pre-line;
    }
    .nav-tabs .nav-link {
        color: var(--text-light);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    .nav-tabs .nav-link.active {
        color: var(--primary);
        background: transparent;
        border-bottom: 3px solid var(--primary);
    }
    @media (max-width: 576px) {
        .profile-picture {
            width: 80px;
            height: 80px;
        }
        .edit-avatar-btn {
            width: 25px;
            height: 25px;
            font-size: 0.8rem;
        }
    }
</style>

<script>
    // Preview avatar sebelum diupload
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'rounded-circle';
                    img.width = 150;
                    img.height = 150;
                    img.alt = 'Profile Avatar Preview';
                    preview.replaceWith(img);
                    document.getElementById('avatarPreview') = img;
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
