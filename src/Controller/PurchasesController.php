<?php
declare(strict_types=1);

namespace App\Controller;

use Migrations\Command\Phinx\Dump;

/**
 * Purchases Controller
 *
 * @property \App\Model\Table\PurchasesTable $Purchases
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('TransactionCode');
    }
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Motorcycles', 'Creators', 'Modifiers'], // Tambahkan Creators dan Modifiers
        ];
        $purchases = $this->paginate($this->Purchases);

        $this->set(compact('purchases'));
    }


    /**
     * View method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => ['Customers', 'Motorcycles'],
        ]);

        $this->set(compact('purchase'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchase = $this->Purchases->newEmptyEntity();
        
        if ($this->request->is('post')) {
            // Ambil data dari form
            $data = $this->request->getData();
            
            // Ambil tanggal dari inputan user
            $transactionDate = $data['date']; 
            
            // Generate kode transaksi menggunakan tanggal input
            $transactionCode = $this->TransactionCode->generateTransactionCode($transactionDate, 'PRC', 'Purchases');

            // Ambil email pengguna dari session
            $session = $this->getRequest()->getSession();
            $userEmail = $session->read('Auth.userEmail');

            // Cari user ID berdasarkan email dari session
            $user = $this->Purchases->Creators->find()
                ->where(['email' => $userEmail])
                ->first();

            if ($user) {
                // Set nilai created_by dengan user ID dan kode transaksi
                $data['created_by'] = $user->id;
                $data['transaction_code'] = $transactionCode;

                // Patch entity dengan accessibleFields
                $purchase = $this->Purchases->patchEntity($purchase, $data, [
                    'accessibleFields' => ['created_by' => true]
                ]);

                // Simpan ke database
                if ($this->Purchases->save($purchase)) {
                    $this->Flash->success(__('The purchase has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    debug($purchase->getErrors()); 
                }
            }

            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        
        $customers = $this->Purchases->Customers->find('list', ['limit' => 200])->all();
        $motorcycles = $this->Purchases->Motorcycles->find('list', ['limit' => 200])->all();
        
        $this->set(compact('purchase', 'customers', 'motorcycles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Ambil entitas Purchase berdasarkan ID
        $purchase = $this->Purchases->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Ambil email pengguna dari session
            $session = $this->getRequest()->getSession();
            $userEmail = $session->read('Auth.userEmail');

            // Cari user ID berdasarkan email dari session menggunakan alias Modifiers
            $user = $this->Purchases->Modifiers->find()
                ->where(['email' => $userEmail])
                ->first();

            if ($user) {
                // Set nilai 'modified_by' dengan user ID
                $data['modified_by'] = $user->id;

                // Patch entity dengan data yang sudah diperbarui
                $purchase = $this->Purchases->patchEntity($purchase, $data);

                if ($this->Purchases->save($purchase)) {
                    $this->Flash->success(__('The purchase has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    debug($purchase->getErrors());
                }
            } else {
                $this->Flash->error(__('User not found.'));
            }

            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }

        $customers = $this->Purchases->Customers->find('list', ['limit' => 200])->all();
        $motorcycles = $this->Purchases->Motorcycles->find('list', ['limit' => 200])->all();
        $this->set(compact('purchase', 'customers', 'motorcycles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchase = $this->Purchases->get($id);
        if ($this->Purchases->delete($purchase)) {
            $this->Flash->success(__('The purchase has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
