import { useState } from 'react'
import { echoClient } from './grpc'
import { Message } from './generated/service'

function App() {
  const [value, setValue] = useState('')
  const [response, setResponse] = useState('')

  const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault()

    try {
      const msg = await echoClient.ping(Message.create({ msg: value }))
      setResponse(msg.response.msg)
    } catch (error) {
      console.error('Error:', error)
    }
  }

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <label htmlFor="input">Input: </label>
        <input id="input" type="text" value={value} onChange={e => setValue(e.target.value)} />{' '}
        <button type='submit'>Send</button>
      </form>
      <p>Reply: {response}</p>
    </div>
  )
}

export default App
