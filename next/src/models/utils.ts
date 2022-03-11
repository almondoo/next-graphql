export interface Column<T = any> {
  id: string;
  label: string;
  minWidth: number;
  maxWidth?: number;
  align?: 'right' | 'center';
  format?: (value: number) => string;
  getValue?: (row: T) => string | number;
  route?: string;
}

export type Paginate = {
  currentPage: number;
  hasMorePages: boolean;
  lastPage: number;
};
