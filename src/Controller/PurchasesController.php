<?php
declare(strict_types=1);

namespace App\Controller;

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
            'contain' => ['Customers', 'Motorcycles'],
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

            // Patch entity dengan data form
            $purchase = $this->Purchases->patchEntity($purchase, $data);
            
            // Set kode transaksi ke entity
            $purchase->transaction_code = $transactionCode;

            // Simpan ke database
            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase could not be saved. Please, try again.'));
        }
        
        // Ambil data untuk select options
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
        $purchase = $this->Purchases->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());
            if ($this->Purchases->save($purchase)) {
                $this->Flash->success(__('The purchase has been saved.'));

                return $this->redirect(['action' => 'index']);
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
