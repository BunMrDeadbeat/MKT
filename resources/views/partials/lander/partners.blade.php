<section id="6" style="background-color: mktPurple; position: relative; width: 100%; max-width: 1343px; overflow: hidden; margin: 0 auto;" class="p-6 rounded-4xl shadow-blue-800  shadow-2xl z-10">
  
  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; attachment: fixed;">
    <video 
      style="width: 100%; height: 100%; object-fit: cover;" 
      autoplay muted loop playsinline disablepictureinpicture 
      src="{{ asset('storage/videos/217850.mp4') }}" 
      preload="metadata"> 
    </video>
  </div>

 <div style="position: relative; z-index: 2; text-align: center; padding: 20px;">
    <h2 class="font-bold text-mktGreen" 
        style="
          font-family: 'YADZ-daqhUw 0', sans-serif; 
          font-size: 5vw; 
          color: #00cc00; 
          line-height: 1.2; 
          letter-spacing: -0.075em; 
          text-transform: uppercase;
          /* CSS SOLUTION HERE */
          text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        ">
        NUESTROS CLIENTES
    </h2>
 </div>

  <!-- Image Grid -->
  <div style="position: relative; z-index: 2; display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; padding: 20px; justify-content: space-around;">
    @forelse ($partnerImages as $image)
        <img 
            src="{{ asset('storage/images/partners/' . $image) }}" 
            alt="Cliente Logo {{ $loop->iteration }}" 
            loading="lazy" 
            style="width: 100%; height: auto;">
    @empty
        <p style="color: white; grid-column: 1 / -1; text-align: center;">No hay imágenes de clientes para mostrar.</p>
    @endforelse
  </div>
</section>