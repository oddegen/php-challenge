import { render, screen, fireEvent, cleanup } from '@testing-library/react';
import '@testing-library/jest-dom/vitest';
import App from '../src/App';
import { afterEach, describe, expect, it, vi } from 'vitest';

vi.mock('../src/grpc', () => ({
  echoClient: {
    ping: vi.fn().mockResolvedValue({ response: { msg: 'TEST' } }),
  },
}));

afterEach(() => {
  cleanup();
})

describe('App Integration Test', () => {
  it('should send input to gRPC client and display the response', async () => {
    render(<App />);

    const input = screen.getByLabelText(/input/i);
    const button = screen.getByRole('button', { name: /send/i });

    fireEvent.change(input, { target: { value: 'test' } });
    fireEvent.click(button);

    await screen.findByText(/test/i);
    expect(screen.getByText(/test/i)).toBeInTheDocument();
  });
});