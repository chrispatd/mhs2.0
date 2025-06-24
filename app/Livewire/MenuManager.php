<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MsMenu;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Kelola Menu')]
class MenuManager extends Component
{
    use WithPagination;

    public $menu_id, $name, $route, $icon, $order, $parent_id;
    public $isModalOpen = false;

    public $availableIcons = [
        'home' => 'Home',
        'user' => 'User',
        'cph' => 'Cog',
        'chart-bar' => 'Chart Bar',
        'calendar' => 'Calendar',
        'bell' => 'Bell',
        'bookmark' => 'Bookmark',
        'camera' => 'Camera',
        'check-circle' => 'Check Circle',
    ];

    public function render()
    {
        return view('livewire.menu-manager', [
            'menus' => MsMenu::with('submenus')->orderBy('order', 'asc')->paginate(10),
            'icons' => $this->availableIcons,
            'parentMenus' => MsMenu::whereNull('parent_id')->orderBy('name', 'asc')->get(),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
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

    private function resetInputFields()
    {
        $this->menu_id = null;
        $this->name = '';
        $this->route = '';
        $this->icon = '';
        $this->order = 0;
        $this->parent_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'icon' => 'required|string|max:255|in:' . implode(',', array_keys($this->availableIcons)),
            'order' => 'required|integer',
            'parent_id' => 'nullable|exists:ms_menu,id|not_in:' . ($this->menu_id ?: 0),
        ]);

        MsMenu::updateOrCreate(['id' => $this->menu_id], [
            'name' => $this->name,
            'route' => $this->route,
            'icon' => $this->icon,
            'order' => $this->order,
            'parent_id' => $this->parent_id ?: null,
        ]);

        session()->flash(
            'message',
            $this->menu_id ? 'Menu Berhasil Diperbarui.' : 'Menu Berhasil Dibuat.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $menu = MsMenu::findOrFail($id);
        $this->menu_id = $id;
        $this->name = $menu->name;
        $this->route = $menu->route;
        $this->icon = $menu->icon;
        $this->order = $menu->order;
        $this->parent_id = $menu->parent_id;

        $this->openModal();
    }

    public function delete($id)
    {
        $menu = MsMenu::findOrFail($id);
        if ($menu->submenus()->count() > 0) {
            session()->flash('message', 'Tidak dapat menghapus menu karena memiliki submenu.');
            return;
        }
        $menu->delete();
        session()->flash('message', 'Menu Berhasil Dihapus.');
    }
}