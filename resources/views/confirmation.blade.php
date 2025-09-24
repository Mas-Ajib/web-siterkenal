<!-- Link Google Fonts Montserrat -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

<style>
  .font-montserrat { font-family: 'Montserrat', sans-serif; }
  .bg-gradient-blue {
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
  }
  .card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    padding: 2.5rem 3rem;
    max-width: 480px;
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    text-align: center;
  }
  .card h2 {
    color: #1e3a8a;
    font-weight: 700;
    font-size: 1.75rem;
    margin-bottom: 1rem;
  }
  .card p {
    color: #3b4a6b;
    font-weight: 400;
    margin-bottom: 2rem;
    line-height: 1.5;
  }
  .btn-primary {
    background-color: #2563eb;
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.75rem;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
  }
  .btn-primary:hover {
    background-color: #1e40af;
    box-shadow: 0 6px 16px rgba(30, 64, 175, 0.6);
  }
</style>

<div class="bg-gradient-blue font-montserrat">
  <div class="card">
    <h2>{{ $title ?? 'Konfirmasi Pengisian Formulir' }}</h2>
    <p>
      Terima kasih telah mengisi formulir layanan.<br />
      Untuk konfirmasi lebih lanjut, silakan hubungi nomor WhatsApp berikut:
    </p>
    <a href="https://wa.me/{{ $phone ?? '628975419000' }}" 
       target="_blank" 
       class="btn-primary"
       rel="noopener noreferrer">
      Hubungi via WhatsApp
    </a>
  </div>
</div>
