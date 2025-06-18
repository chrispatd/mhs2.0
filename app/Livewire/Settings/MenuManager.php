<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\Menu;

class MenuManager extends Component
{
    public $menus, $mainMenus;
    public $menu_id, $name, $route_name, $icon, $parent_id, $order;
    public $isModalOpen = false;

    // Aturan validasi
    protected $rules = [
        'name' => 'required|string|max:255',
        'route_name' => 'required|string|max:255',
        'icon' => 'nullable|string|max:255',
        'parent_id' => 'nullable|exists:menus,id',
        'order' => 'required|integer',
    ];

    public function render()
    {
        // Ambil menu utama (yang tidak punya parent) beserta relasi children-nya
        $this->menus = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
        return view('livewire.settings.menu-manager')
            ->with(['title' => 'Menu Management']);
    }

    public function create()
    {
        $this->resetForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }



    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetForm()
    {
        $this->menu_id = null;
        $this->name = '';
        $this->route_name = '';
        $this->icon = '';
        $this->parent_id = null;
        $this->order = 0;
    }

    public function store()
    {
        $this->validate();

        Menu::updateOrCreate(['id' => $this->menu_id], [
            'name' => $this->name,
            'route_name' => $this->route_name,
            'icon' => $this->icon,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
        ]);

        session()->flash('message', $this->menu_id ? 'Menu berhasil diperbarui.' : 'Menu berhasil dibuat.');

        $this->closeModal();
        $this->resetForm();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menu_id = $id;
        $this->name = $menu->name;
        $this->route_name = $menu->route_name;
        $this->icon = $menu->icon;
        $this->parent_id = $menu->parent_id;
        $this->order = $menu->order;

        $this->openModal();
    }

    public function delete($id)
    {
        Menu::find($id)->delete();
        session()->flash('message', 'Menu berhasil dihapus.');
    }
}
