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

    public $menu_id, $name, $route, $icon, $order;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.menu-manager', [
            'menus' => MsMenu::orderBy('order', 'asc')->paginate(10)
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
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        MsMenu::updateOrCreate(['id' => $this->menu_id], [
            'name' => $this->name,
            'route' => $this->route,
            'icon' => $this->icon,
            'order' => $this->order,
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

        $this->openModal();
    }

    public function delete($id)
    {
        MsMenu::find($id)->delete();
        session()->flash('message', 'Menu Berhasil Dihapus.');
    }
}
