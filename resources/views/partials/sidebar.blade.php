 <div class="sidebar-wrapper" data-simplebar="true">
     <div class="sidebar-header bg-dark">
         <div>
             <img src="{{ asset('logo1.png') }}" class="logo-icon" alt="logo icon">
         </div>
         <div>
             <h4 class="logo-text text-light">HOLOGRAM</h4>
         </div>
         <div class="toggle-icon ms-auto text-light"><i class='bx bx-arrow-to-left'></i>
         </div>
     </div>
     <!--navigation-->
     <ul class="metismenu" id="menu">
         <li>
             <a href="{{ url('home') }}">
                 <div class="parent-icon"><i class='bx bx-home-circle'></i>
                 </div>
                 <div class="menu-title">Dashboard</div>
             </a>
         </li>

         <li class="menu-label">Program & Feature</li>
         <li>
             <a href="{{ url('pos') }}">
                 <div class="parent-icon"><i class="bx bx-dollar-circle"></i></div>
                 <div class="menu-title">
                     POS
                 </div>
             </a>
         </li>
         <li>
             <a href="javascript:;" class="has-arrow">
                 <div class="parent-icon"><i class='bx bx-shopping-bag'></i>
                 </div>
                 <div class="menu-title">Produk</div>
             </a>
             <ul>
                 <li>
                     <a href="{{ url('kategori') }}"><i class="bx bx-right-arrow-alt"></i>Kategori</a>
                 </li>
                 <li>
                     <a href="{{ url('tambah-produk') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Produk</a>
                 </li>
                 <li>
                     <a href="{{ url('produk') }}"><i class="bx bx-right-arrow-alt"></i>All Produk</a>
                 </li>
             </ul>
         </li>

         <li>
             <a href="javascript:;" class="has-arrow">
                 <div class="parent-icon"><i class='bx bx-cart'></i>
                 </div>
                 <div class="menu-title">Pembelian</div>
             </a>
             <ul>
                 <li>
                     <a href="{{ url('tambah-pembelian') }}"><i class="bx bx-right-arrow-alt"></i>
                         Buat Pembelian
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('pembelian') }}"><i class="bx bx-right-arrow-alt"></i>All Pembelian</a>
                 </li>
             </ul>
         </li>
         <li>
             <a href="javascript:;" class="has-arrow">
                 <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                 </div>
                 <div class="menu-title">Order</div>
             </a>
             <ul>
                 <li>
                     <a href="{{ url('tambah-order') }}"><i class="bx bx-right-arrow-alt"></i>Buat Order</a>
                 </li>
                 <li>
                     <a href="{{ url('order') }}"><i class="bx bx-right-arrow-alt"></i>All Order</a>
                 </li>
             </ul>
         </li>

         <li>
             <a class="has-arrow" href="javascript:;">
                 <div class="parent-icon"><i class='bx bx-user-circle'></i>
                 </div>
                 <div class="menu-title">Peoples</div>
             </a>
             <ul>
                 <li>
                     <a href="{{ url('customers') }}"><i class="bx bx-right-arrow-alt"></i>Customers</a>
                 </li>
                 <li>
                     <a href="{{ url('suppliers') }}"><i class="bx bx-right-arrow-alt"></i>Suppliers</a>
                 </li>
             </ul>
         </li>
     </ul>
     <!--end navigation-->
 </div>
