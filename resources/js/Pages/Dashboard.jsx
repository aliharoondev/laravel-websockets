import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import Echo from 'laravel-echo'
import axios from 'axios';

export default function Dashboard({ auth, messages }) {

    const [message, setMessage] = useState('');
    const [messageList, setMessageList] = useState(messages);

    useEffect(() => {
        // var receiverId = 2;
        // window.Echo.private(`chat.1.2`)
        //     .listen('MessageSent', (event) => {
        //         console.log('Event', event);
        //         console.log('Event', event.message);
        //         setMessageList(prevMessages => [...prevMessages, event.message]);
        //     });
    }, []);

    const sendMessage = (e) => {
        e.preventDefault();
        var receiverId = 2;
        axios.post('/messages/send', { message, receiver_id: receiverId }).then((res) => {
            setMessage('');
            messageList.push({ message });
        });
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                        <div className='flex flex-col h-96 overflow-y-auto'>
                            {
                                messageList && messageList.map((msg, index) => (
                                    <div className='p-3 border-b' key={index}>
                                        <small className="text-gray-500 font-semibold" >{msg.message}</small>
                                    </div>
                                ))
                            }
                        </div>
                        <form action="" className='p-6' onSubmit={sendMessage}>
                            <div className='flex  justify-items-center items-center space-x-1'>
                                <input type="text" placeholder='type here...' className='w-full m-1 rounded-lg' required value={message} onChange={(e) => setMessage(e.target.value)} />
                                <button className=' p-2 rounded-lg border bg-green-400 hover:bg-white hover:border-green-400 hover:text-green-600 hover:font-bold' type='submit'>send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
