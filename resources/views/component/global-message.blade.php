@if (session('userLogout'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('userLogout') }}
    </div>
@endif

@if (session('NotAdmin'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('NotAdmin') }}
    </div>
@endif
@if (session('notLoggedIn'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('notLoggedIn') }}
    </div>
@endif
@if (session('AdminLogin'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('AdminLogin') }}
    </div>
@endif
@if (session('AdminLogout'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('AdminLogout') }}
    </div>
@endif
@if (session('loginError'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('loginError') }}
    </div>
@endif
@if (session('adminNotLoggedIn'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('adminNotLoggedIn') }}
    </div>
@endif
@if (session('deleted'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('deleted') }}
    </div>
@endif
@if (session('newCategory'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('newCategory') }}
    </div>
@endif

@if (session('productUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('productUpdated') }}
    </div>
@endif
@if (session('newProductAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('newProductAdded') }}
    </div>
@endif
@if (session('categoryUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('categoryUpdated') }}
    </div>
@endif
@if (session('CategoryDeleted'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('CategoryDeleted') }}
    </div>
@endif
@if (session('FilterDeleted'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('FilterDeleted') }}
    </div>
@endif
@if (session('FilterAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('FilterAdded') }}
    </div>
@endif
@if (session('FilterUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('FilterUpdated') }}
    </div>
@endif
@if (session('colorAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('colorAdded') }}
    </div>
@endif
@if (session('colorUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('colorUpdated') }}
    </div>
@endif
@if (session('colorDeleted'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('colorDeleted') }}
    </div>
@endif
@if (session('typeAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('typeAdded') }}
    </div>
@endif
@if (session('typeUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('typeUpdated') }}
    </div>
@endif
@if (session('imageUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('imageUpdated') }}
    </div>
@endif
@if (session('typeDeleted'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('typeDeleted') }}
    </div>
@endif
@if (session('SuitableForAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('SuitableForAdded') }}
    </div>
@endif
@if (session('SuitableForUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('SuitableForUpdated') }}
    </div>
@endif
@if (session('TagAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('TagAdded') }}
    </div>
@endif
@if (session('TagUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('TagUpdated') }}
    </div>
@endif
@if (session('hsnAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('hsnAdded') }}
    </div>
@endif
@if (session('hsnUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('hsnUpdated') }}
    </div>
@endif
@if (session('taxAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('taxAdded') }}
    </div>
@endif
@if (session('taxUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('taxUpdated') }}
    </div>
@endif
@if (session('VarientAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('VarientAdded') }}
    </div>
@endif
@if (session('VarientUpdated'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('VarientUpdated') }}
    </div>
@endif
@if (session('UserLogin'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('UserLogin') }}
    </div>
@endif
@if (session('NotUser'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('NotUser') }}
    </div>
@endif
@if (session('VariantImageAdded'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('VariantImageAdded') }}
    </div>
@endif
@if (session('variantImageDeleted'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('variantImageDeleted') }}
    </div>
@endif
@if (session('VariantImageUpdated'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('VariantImageUpdated') }}
    </div>
@endif
@if (session('variantImageAccessDenied'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('variantImageAccessDenied') }}
    </div>
@endif
@if (session('removeItem'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('removeItem') }}
    </div>
@endif
@if (session('emptycart'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('emptycart') }}
    </div>
@endif
@if (session('loginCheck'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('loginCheck') }}
    </div>
@endif
@if (session('addedToCart'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('addedToCart') }}
    </div>
@endif

