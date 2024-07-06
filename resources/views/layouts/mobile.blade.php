<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..."
                required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{ url('') }}">Home</a>
                </li>
                @php
                    $getCategoryHeader = App\Models\CategoryModel::getRecordMenu();
                @endphp
                @foreach ($getCategoryHeader as $value_cate)
                    @if (!empty($value_cate->getSubCategory->count()))
                        <li>
                            <a href="{{ url($value_cate->slug) }}">{{ $value_cate->name }}</a>
                            <ul>
                                @foreach ($value_cate->getSubCategory as $value_sub)
                                    <li><a
                                            href="{{ url($value_cate->slug . '/' . $value_sub->slug) }}">{{ $value_sub->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div>
    </div>
</div>
